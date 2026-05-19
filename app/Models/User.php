<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Zone;
use App\Models\Group;
use App\Models\Contribution;

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
        'name',
        'phone',
        'email',
        'password',
        'zone_id',
        'role',
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
        ];
    }

    // Relationship - a member belong to one zone(one-to-one relationship)
    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    // Relationship - a member belongs many groups(one-to-many relationship)
    public function groups() {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    // Relationship - a member can have many/multiple contributions
    public function contributions() {
        return $this->hasMany(Contribution::class);
    }
}
