<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Currency;
use App\Models\AddressType;
use App\Models\Deposit;
use App\Models\Withdrawal;

class Network extends Model
{
    use SoftDeletes;

    protected $table = 'networks';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function currencies()
    {
        return $this->belongsToMany(Currency::class)
            ->withPivot([
                'deposit_status', 'withdrawal_status',
                'mx_balance', 'contract', 'decimal', 'withdrawal_fee'
            ]);
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }
}
