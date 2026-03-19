<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(Request $request)
    {
        // ── Stats ──────────────────────────────────────────────
        $totalUsers       = User::where('is_admin', false)->count();
        $activeUsers      = User::where('is_admin', false)->where('is_active', true)->where('is_banned', false)->count();
        $deactivatedUsers = User::where('is_admin', false)->where('is_active', false)->count();
        $bannedUsers      = User::where('is_admin', false)->where('is_banned', true)->count();
        $totalConnections = Connection::count();
        $newToday         = User::where('is_admin', false)->whereDate('created_at', today())->count();
        $newThisWeek      = User::where('is_admin', false)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $newThisMonth     = User::where('is_admin', false)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $completeProfiles = User::where('is_admin', false)->where('registration_step', '>=', 3)->count();

        // ── User table (search / filter) ───────────────────────
        $query = User::where('is_admin', false);

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('first_name', 'like', "%{$term}%")
                  ->orWhere('last_name', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('institution', 'like', "%{$term}%");
            });
        }

        if ($request->filled('status')) {
            match ($request->status) {
                'active'      => $query->where('is_active', true)->where('is_banned', false),
                'deactivated' => $query->where('is_active', false),
                'banned'      => $query->where('is_banned', true),
                default       => null,
            };
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        $users = $query->orderByDesc('created_at')->paginate(20)->withQueryString();

        $countries = User::where('is_admin', false)
            ->whereNotNull('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        return view('admin.index', compact(
            'totalUsers', 'activeUsers', 'deactivatedUsers', 'bannedUsers',
            'totalConnections', 'newToday', 'newThisWeek', 'newThisMonth',
            'completeProfiles', 'users', 'countries'
        ));
    }

    /**
     * Toggle a user's active state (deactivate / reactivate).
     */
    public function toggleActive(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot modify another admin.');
        }

        $user->update([
            'is_active'      => ! $user->is_active,
            'deactivated_at' => $user->is_active ? now() : null,
        ]);

        $action = $user->is_active ? 'reactivated' : 'deactivated';
        return back()->with('success', "User {$user->first_name} {$user->last_name} has been {$action}.");
    }

    /**
     * Ban a user (with optional reason).
     */
    public function ban(Request $request, User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot ban an admin.');
        }

        $request->validate([
            'ban_reason' => 'nullable|string|max:500',
        ]);

        $user->update([
            'is_banned'  => true,
            'banned_at'  => now(),
            'ban_reason' => $request->ban_reason,
            'is_active'  => false,
        ]);

        return back()->with('success', "User {$user->first_name} {$user->last_name} has been banned.");
    }

    /**
     * Unban a user.
     */
    public function unban(User $user)
    {
        $user->update([
            'is_banned'  => false,
            'banned_at'  => null,
            'ban_reason' => null,
            'is_active'  => true,
        ]);

        return back()->with('success', "User {$user->first_name} {$user->last_name} has been unbanned.");
    }

    /**
     * Permanently delete a user.
     */
    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot delete an admin account.');
        }

        $name = "{$user->first_name} {$user->last_name}";
        $user->delete();

        return back()->with('success', "User {$name} has been permanently deleted.");
    }
}
