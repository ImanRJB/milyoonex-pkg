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
use Milyoonex\Enum\User2faEnum;
use Milyoonex\Enum\UserGenderEnum;
use App\Models\UserGroup;
use App\Models\Wallet;
use App\Models\CreditCard;
use App\Models\Country;
use App\Models\Notification;
use App\Models\ReferralCode;
use App\Models\Address;
use App\Models\Alert;
use App\Models\ReferralReward;
use App\Models\WithdrawTrustedAddress;

use function PHPUnit\Framework\isNull;

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

    protected $appends = [
        'mobile_mask',
        'email_mask',
        'phone_mask',
        'ga_secret_status'
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

    public function withdrawTrustedAddreses()
    {
        return $this->hasMany(WithdrawTrustedAddress::class);
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

    public function getMobileMaskAttribute()
    {
        if(! empty($this->mobile)) {
            return substr($this->mobile, 0, 4)
            . str_repeat('*', strlen($this->mobile) - 8)
            . substr($this->mobile, -4);
        }
        return null;
    }

    public function getEmailMaskAttribute()
    {
        if(! empty($this->email)) {
            $explodedMail = explode('@', $this->email);
            
            if(strlen($explodedMail[0]) > 4) {
                return substr($explodedMail[0], 0, 2)
                . str_repeat('*', strlen($explodedMail[0]) - 4)
                . substr($explodedMail[0], -2)
                . '@'
                . $explodedMail[1];
            
            } else {
                return substr($explodedMail[0], 0, 1)
                . str_repeat('*', strlen($explodedMail[0]) - 2)
                . substr($explodedMail[0], -1)
                . '@'
                . $explodedMail[1];
            }
        }
        return null;
    }

    public function getPhoneMaskAttribute()
    {
        if(! empty($this->phone)) {
            return substr($this->phone, 0, 3)
            . str_repeat('*', strlen($this->phone) - 7)
            . substr($this->phone, -4);
        }
        return null;
    }

    public function getGaSecretStatusAttribute()
    {
        if(! is_null($this->ga_secret)) {
            return true;
        }
        return false;
    }
}
