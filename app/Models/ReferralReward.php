<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Currency;
use App\Models\User;

class ReferralReward extends Model
{
    use SoftDeletes;

    protected $table = 'referral_rewards';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function referralUser()
    {
        return $this->belongsTo(User::class,'referral_user_id');
    }
}