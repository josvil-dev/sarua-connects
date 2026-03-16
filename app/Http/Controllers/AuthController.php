<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Connection;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Show home page
    public function home()
    {
        return view('home');
    }

    // Show registration step 1 form
    public function showRegisterStep1()
    {
        return view('auth.register-step1');
    }

    // Process registration step 1
    public function processRegisterStep1(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Store user with step 1 data
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'registration_step' => 1,
        ]);

        // Store user ID in session for registration steps
        session(['registration_user_id' => $user->id]);

        return redirect()->route('register.step2')->with('success', 'Account created! Please complete your profile.');
    }

    // Show registration step 2 form
    public function showRegisterStep2()
    {
        // Check if user has completed step 1
        if (!session('registration_user_id')) {
            return redirect()->route('register')->with('error', 'Please start registration from the beginning.');
        }
        return view('auth.register-step2');
    }

    // Process registration step 2
    public function processRegisterStep2(Request $request)
    {
        // Check if user has valid session
        if (!session('registration_user_id')) {
            return redirect()->route('register')->with('error', 'Please start registration from the beginning.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'highest_qualification' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'keywords' => 'required|string|max:500',
            'areas_of_interest' => 'required|array|min:1',
            'areas_of_interest.*' => 'string|max:100',
            'isced_codes' => 'required|array|min:1',
            'isced_codes.*' => 'string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $user = User::find(session('registration_user_id'));
        $updateData = [
            'title' => $request->title,
            'highest_qualification' => $request->highest_qualification,
            'institution' => $request->institution,
            'job_title' => $request->job_title,
            'country' => $request->country,
            'bio' => $request->bio,
            'keywords' => $request->keywords,
            'areas_of_interest' => $request->areas_of_interest,
            'isced_codes' => $request->isced_codes,
            'registration_step' => 2,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $updateData['photo'] = $photoPath;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $updateData['cv'] = $cvPath;
        }

        $user->update($updateData);

        return redirect()->route('register.step3');
    }

    // Show registration step 3 form
    public function showRegisterStep3()
    {
        // Check if user has completed step 2
        if (!session('registration_user_id')) {
            return redirect()->route('register')->with('error', 'Please start registration from the beginning.');
        }
        
        $user = User::find(session('registration_user_id'));
        if (!$user || $user->registration_step < 2) {
            return redirect()->route('register.step2')->with('error', 'Please complete step 2 first.');
        }
        
        return view('auth.register-step3');
    }

    // Process registration step 3
    public function processRegisterStep3(Request $request)
    {
        // Check if user has valid session
        if (!session('registration_user_id')) {
            return redirect()->route('register')->with('error', 'Please start registration from the beginning.');
        }

        $request->validate([
            'consent' => 'required|accepted',
        ]);

        $user = User::find(session('registration_user_id'));
        $user->update([
            'registration_step' => 3,
        ]);

        // Clear the registration session
        session()->forget('registration_user_id');

        return redirect()->route('login')->with('success', 'Registration completed successfully! You can now log in.');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Process login
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            // Only allow login if registration is complete
            if ($user->registration_step < 3) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Please complete your registration first.',
                ]);
            }
            
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get pending connection requests received by this user
        $connectionRequests = $user->receivedConnections()
                                 ->where('status', 'pending')
                                 ->with('requester')
                                 ->orderBy('created_at', 'desc')
                                 ->take(4)
                                 ->get();
        
        // Get connections (accepted connections with the connected users)
        $connectionIds = collect();
        
        // Get connections where user sent the request
        $sentConnections = $user->sentConnections()->where('status', 'accepted')->pluck('requested_id');
        $connectionIds = $connectionIds->merge($sentConnections);
        
        // Get connections where user received the request
        $receivedConnections = $user->receivedConnections()->where('status', 'accepted')->pluck('requester_id');
        $connectionIds = $connectionIds->merge($receivedConnections);
        
        $connections = User::whereIn('id', $connectionIds->unique())->take(6)->get();
        
        // Get connection suggestions (users not yet connected and not pending)
        $excludeIds = $connectionIds->push($user->id); // Exclude self and current connections
        
        // Also exclude users with pending connections
        $pendingConnections = $user->sentConnections()->where('status', 'pending')->pluck('requested_id');
        $pendingReceived = $user->receivedConnections()->where('status', 'pending')->pluck('requester_id');
        $excludeIds = $excludeIds->merge($pendingConnections)->merge($pendingReceived);
        
        $suggestions = User::whereNotIn('id', $excludeIds->unique())
                          ->where('registration_step', '>=', 2)
                          ->inRandomOrder()
                          ->take(4)
                          ->get();
        
        // Get recent activity/updates
        $recentConnections = User::whereIn('id', $connectionIds->unique())
                                ->orderBy('updated_at', 'desc')
                                ->take(3)
                                ->get();
        
        // Get recent notifications
        $recentNotifications = $user->notifications()
                                  ->take(5)
                                  ->get();
        
        return view('dashboard', compact('connectionRequests', 'connections', 'suggestions', 'recentConnections', 'recentNotifications'));
    }

    // Show edit profile form
    public function showEditProfile()
    {
        return view('auth.edit-profile');
    }

    // Process profile update
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'title' => 'required|string|max:255',
            'highest_qualification' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'bio' => 'required|string|max:1000',
            'keywords' => 'required|string|max:500',
            'areas_of_interest' => 'required|array|min:1',
            'areas_of_interest.*' => 'string|max:100',
            'isced_codes' => 'required|array|min:1',
            'isced_codes.*' => 'string|max:100',
        ]);

        $updateData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'title' => $request->title,
            'highest_qualification' => $request->highest_qualification,
            'institution' => $request->institution,
            'job_title' => $request->job_title,
            'country' => $request->country,
            'bio' => $request->bio,
            'keywords' => $request->keywords,
            'areas_of_interest' => $request->areas_of_interest,
            'isced_codes' => $request->isced_codes,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $updateData['photo'] = $photoPath;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($user->cv && Storage::disk('public')->exists($user->cv)) {
                Storage::disk('public')->delete($user->cv);
            }
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $updateData['cv'] = $cvPath;
        }

        $user->update($updateData);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    // Show search page
    public function showSearch(Request $request)
    {
        $query = User::where('registration_step', '>=', 2); // Only show users with some profile info
        
        // Apply filters
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        
        if ($request->filled('institution')) {
            $query->where('institution', 'like', '%' . $request->institution . '%');
        }
        
        if ($request->filled('job_title')) {
            $query->where('job_title', 'like', '%' . $request->job_title . '%');
        }
        
        if ($request->filled('keywords')) {
            $query->where('keywords', 'like', '%' . $request->keywords . '%');
        }
        
        if ($request->filled('areas_of_interest')) {
            $query->whereJsonContains('areas_of_interest', $request->areas_of_interest);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('job_title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('institution', 'like', '%' . $searchTerm . '%')
                  ->orWhere('keywords', 'like', '%' . $searchTerm . '%')
                  ->orWhere('bio', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $users = $query->paginate(12);
        
        // Optimize dropdown queries with caching and limits
        $countries = cache()->remember('search_countries', 3600, function () {
            return User::whereNotNull('country')
                      ->where('registration_step', '>=', 2)
                      ->distinct()
                      ->orderBy('country')
                      ->limit(100)
                      ->pluck('country');
        });
        
        $institutions = cache()->remember('search_institutions', 3600, function () {
            return User::whereNotNull('institution')
                      ->where('registration_step', '>=', 2)
                      ->distinct()
                      ->orderBy('institution')
                      ->limit(100)
                      ->pluck('institution');
        });
        
        $jobTitles = cache()->remember('search_job_titles', 3600, function () {
            return User::whereNotNull('job_title')
                      ->where('registration_step', '>=', 2)
                      ->distinct()
                      ->orderBy('job_title')
                      ->limit(100)
                      ->pluck('job_title');
        });
        
        return view('search.index', compact('users', 'countries', 'institutions', 'jobTitles'));
    }

    // Show individual user profile
    public function showProfile(User $user, Request $request)
    {
        // Ensure user has completed at least step 2 of registration
        if ($user->registration_step < 2) {
            return redirect()->route('search')->with('error', 'Profile not available yet.');
        }
        
        // Pass search parameters to maintain search state
        $searchParams = $request->query();
        
        return view('search.profile', compact('user', 'searchParams'));
    }

    // Show my profile page
    public function showMyProfile()
    {
        $user = Auth::user();
        return view('my-profile', compact('user'));
    }

    // Deactivate user profile
    public function deactivateProfile(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Set user status to inactive
            $user->update([
                'is_active' => false,
                'deactivated_at' => now()
            ]);

            // Logout the user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'success' => true,
                'message' => 'Account deactivated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to deactivate account. Please try again.'
            ], 500);
        }
    }

    // Delete user profile permanently
    public function deleteProfile(Request $request)
    {
        try {
            $user = Auth::user();

            // Delete user's uploaded files
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            if ($user->cv) {
                Storage::disk('public')->delete($user->cv);
            }

            // Delete related data
            $user->sentConnections()->delete();
            $user->receivedConnections()->delete();
            $user->notifications()->delete();

            // Delete the user
            $userId = $user->id;
            $user->delete();

            // Logout
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'success' => true,
                'message' => 'Account deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to delete account. Please try again.'
            ], 500);
        }
    }

    // Download user data
    public function downloadUserData()
    {
        try {
            $user = Auth::user();
            
            // Prepare user data
            $userData = [
                'personal_information' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'title' => $user->title,
                    'job_title' => $user->job_title,
                    'institution' => $user->institution,
                    'country' => $user->country,
                    'highest_qualification' => $user->highest_qualification,
                    'bio' => $user->bio,
                    'keywords' => $user->keywords,
                    'areas_of_interest' => $user->areas_of_interest,
                    'isced_codes' => $user->isced_codes,
                    'member_since' => $user->created_at->format('Y-m-d H:i:s'),
                    'last_updated' => $user->updated_at->format('Y-m-d H:i:s'),
                ],
                'connections' => [],
                'notifications' => []
            ];

            // Add connections data
            $sentConnections = $user->sentConnections()->with('requested')->get();
            $receivedConnections = $user->receivedConnections()->with('requester')->get();
            
            foreach ($sentConnections as $connection) {
                $userData['connections'][] = [
                    'type' => 'sent',
                    'connected_with' => $connection->requested->first_name . ' ' . $connection->requested->last_name,
                    'connected_with_email' => $connection->requested->email,
                    'status' => $connection->status,
                    'date' => $connection->created_at->format('Y-m-d H:i:s')
                ];
            }

            foreach ($receivedConnections as $connection) {
                $userData['connections'][] = [
                    'type' => 'received',
                    'connected_with' => $connection->requester->first_name . ' ' . $connection->requester->last_name,
                    'connected_with_email' => $connection->requester->email,
                    'status' => $connection->status,
                    'date' => $connection->created_at->format('Y-m-d H:i:s')
                ];
            }

            // Add notifications data
            $notifications = $user->notifications()->orderBy('created_at', 'desc')->get();
            foreach ($notifications as $notification) {
                $userData['notifications'][] = [
                    'type' => $notification->type,
                    'message' => $notification->message,
                    'read' => $notification->read_at ? true : false,
                    'date' => $notification->created_at->format('Y-m-d H:i:s')
                ];
            }

            $fileName = 'sarua_connect_data_' . $user->id . '_' . date('Y-m-d') . '.json';
            
            return response()->json($userData)
                ->header('Content-Type', 'application/json')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to download data. Please try again.');
        }
    }
}
