<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// start passport-auth traits
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;
// end passport-auth traits
use Milyoomex\Enum\User2faEnum;
use Milyoomex\Enum\UserGenderEnum;
use App\Models\UserGroup;
use App\Models\Wallet;
use App\Models\CreditCard;
use App\Models\Country;
use App\Models\Notification;
use App\Models\ReferralCode;
use App\Models\Address;
use App\Models\Alert;
use App\Models\ReferralReward;

class User extends Model
{
    use SoftDeletes, HasApiTokens, Authenticatable, Authorizable;

    protected $table = 'users';

    protected $hidden = [
        'password'
    ];

    protected $guarded = [
        'id',
        'user_group_id',
        'shahkar' ,
        'block',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'gender' => UserGenderEnum::class,
        '2fa'    => User2faEnum::class,
    ];

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function referralCodes()
    {
        return $this->hasMany(ReferralCode::class);
    }

    public function referredBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'referral_user_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function userReward()
    {
        return $this->hasMany(ReferralReward::class, 'user_id');
    }

    public function refferalUserReward()
    {
        return $this->hasMany(ReferralReward::class, 'referral_user_id');
    }

    // start passport-auth methods
    public function findForPassport($username)
    {
        return $this->where(function ($query) use ($username) {
            $query->where('email', $username)->orWhere('mobile', $username);
        })->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
    // end passport-auth methods
}
