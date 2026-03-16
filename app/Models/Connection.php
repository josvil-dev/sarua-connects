<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'requested_id', 
        'status'
    ];

    /**
     * Get the user who sent the connection request
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    /**
     * Get the user who received the connection request
     */
    public function requested()
    {
        return $this->belongsTo(User::class, 'requested_id');
    }

    /**
     * Check if two users are connected
     */
    public static function areConnected($userId1, $userId2)
    {
        return self::where(function ($query) use ($userId1, $userId2) {
            $query->where('requester_id', $userId1)
                  ->where('requested_id', $userId2);
        })->orWhere(function ($query) use ($userId1, $userId2) {
            $query->where('requester_id', $userId2)
                  ->where('requested_id', $userId1);
        })->where('status', 'accepted')->exists();
    }

    /**
     * Get connection status between two users
     */
    public static function getConnectionStatus($userId1, $userId2)
    {
        return self::where(function ($query) use ($userId1, $userId2) {
            $query->where('requester_id', $userId1)
                  ->where('requested_id', $userId2);
        })->orWhere(function ($query) use ($userId1, $userId2) {
            $query->where('requester_id', $userId2)
                  ->where('requested_id', $userId1);
        })->first();
    }
}
