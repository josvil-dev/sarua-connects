<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    /**
     * Send a connection request
     */
    public function sendRequest(Request $request, $userId)
    {
        $currentUser = Auth::user();
        $targetUser = User::findOrFail($userId);

        // Prevent self-connection
        if ($currentUser->id == $userId) {
            return response()->json(['error' => 'Cannot connect to yourself'], 400);
        }

        // Check if connection already exists
        $existingConnection = Connection::getConnectionStatus($currentUser->id, $userId);
        
        if ($existingConnection) {
            return response()->json(['error' => 'Connection already exists'], 400);
        }

        // Create connection request
        $connection = Connection::create([
            'requester_id' => $currentUser->id,
            'requested_id' => $userId,
            'status' => 'pending'
        ]);

        // Create notification for the target user
        Notification::create([
            'user_id' => $userId,
            'type' => 'connection_request',
            'title' => 'New Connection Request',
            'message' => $currentUser->first_name . ' ' . $currentUser->last_name . ' wants to connect with you.',
            'data' => [
                'connection_id' => $connection->id,
                'requester_id' => $currentUser->id,
                'requester_name' => $currentUser->first_name . ' ' . $currentUser->last_name
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Connection request sent successfully!'
        ]);
    }

    /**
     * Accept a connection request
     */
    public function acceptRequest(Request $request, $connectionId)
    {
        $connection = Connection::findOrFail($connectionId);
        
        // Ensure the current user is the recipient
        if ($connection->requested_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $connection->update(['status' => 'accepted']);

        // Mark the related notification as read
        Notification::where('user_id', Auth::id())
            ->where('type', 'connection_request')
            ->whereJsonContains('data->connection_id', $connection->id)
            ->update(['read_at' => now()]);

        // Notify the requester
        Notification::create([
            'user_id' => $connection->requester_id,
            'type' => 'connection_accepted',
            'title' => 'Connection Accepted',
            'message' => Auth::user()->first_name . ' ' . Auth::user()->last_name . ' accepted your connection request.',
            'data' => [
                'connection_id' => $connection->id,
                'accepted_by_id' => Auth::id(),
                'accepted_by_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Connection request accepted!'
        ]);
    }

    /**
     * Decline a connection request
     */
    public function declineRequest(Request $request, $connectionId)
    {
        $connection = Connection::findOrFail($connectionId);
        
        // Ensure the current user is the recipient
        if ($connection->requested_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $connection->update(['status' => 'declined']);

        // Mark the related notification as read
        Notification::where('user_id', Auth::id())
            ->where('type', 'connection_request')
            ->whereJsonContains('data->connection_id', $connection->id)
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Connection request declined.'
        ]);
    }

    /**
     * Get connection status between current user and target user
     */
    public function getConnectionStatus($userId)
    {
        $connection = Connection::getConnectionStatus(Auth::id(), $userId);
        
        $status = [
            'connected' => false,
            'pending' => false,
            'sent_by_current_user' => false,
            'connection_id' => null
        ];

        if ($connection) {
            $status['connection_id'] = $connection->id;
            
            if ($connection->status === 'accepted') {
                $status['connected'] = true;
            } elseif ($connection->status === 'pending') {
                $status['pending'] = true;
                $status['sent_by_current_user'] = $connection->requester_id === Auth::id();
            }
        }

        return response()->json($status);
    }
}
