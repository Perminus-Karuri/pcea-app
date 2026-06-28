<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// import models
use App\Models\User;
use App\Models\ContributionType;

class Contribution extends Model
{
    protected $fillable = [
        'user_id',
        'contribution_type_id',
        'phone',
        'amount',
        'status',
        'mpesa_receipt_number',
        'checkout_request_id',
        'transaction_date',

    ];

    // one-to-one relationship - one contribution belongs to one user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // one-to-one relationship - a contribution belongs to one contribution type
    public function contributionType() {
        return $this->belongsTo(ContributionType::class);
    }
}
