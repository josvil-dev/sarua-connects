<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', // Keep for backward compatibility
        'first_name',
        'last_name',
        'email',
        'password',
        'title',
        'highest_qualification',
        'institution',
        'job_title',
        'country',
        'photo',
        'cv',
        'bio',
        'keywords',
        'areas_of_interest',
        'isced_codes',
        'registration_step',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'areas_of_interest' => 'array',
            'isced_codes' => 'array',
        ];
    }

    /**
     * Get connection requests sent by this user
     */
    public function sentConnections()
    {
        return $this->hasMany(Connection::class, 'requester_id');
    }

    /**
     * Get connection requests received by this user
     */
    public function receivedConnections()
    {
        return $this->hasMany(Connection::class, 'requested_id');
    }

    /**
     * Get all connections (sent and received) that are accepted
     */
    public function connections()
    {
        return $this->sentConnections()->where('status', 'accepted')
            ->union($this->receivedConnections()->where('status', 'accepted'));
    }

    /**
     * Get notifications for this user
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get unread notifications count
     */
    public function getUnreadNotificationsCountAttribute()
    {
        return $this->notifications()->whereNull('read_at')->count();
    }
}
