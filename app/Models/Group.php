<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // import user model

class Group extends Model
{
    protected $fillable = ["name"];

    // many-to-many relationship - a group has many members (members can belong to many groups)
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
