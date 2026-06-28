<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// import model
use App\Model\Contribution;

class ContributionType extends Model
{
    protected $fillable = [
        'name',
    ];

    // one-to-many relationship - a contribution type can have many contribution entries
    public function contributions() {
        return $this->hasMany(Contribution::class);
    }
}
