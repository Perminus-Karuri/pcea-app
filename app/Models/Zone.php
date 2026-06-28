<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// import model
use App\Models\User;

class Zone extends Model
{
    protected $fillable = [
        'name',
    ];
    
    // one-to-many relationship - one zone has many members (members belong to one zone)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
