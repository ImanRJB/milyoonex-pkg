<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Currency;
use App\Models\Order;
use App\Models\SystemOrder;
use App\Models\Deposit;
use App\Models\IrtDeposit;
use App\Models\Withdrawal;
use App\Models\IrtWithdrawal;

class Wallet extends Model
{
    use SoftDeletes;

    protected $table = 'wallets';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'user_id',
        'currency_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'buy_freeze', 'sell_freeze', 'total_freeze'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function irtDeposits()
    {
        return $this->hasMany(IrtDeposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function irtWithdrawals()
    {
        return $this->hasMany(IrtWithdrawal::class);
    }

    public function sellOrders()
    {
        return $this->hasMany(Order::class, 'wallet_id')->where('side', '=', 'sell');
    }

    public function buyOrders()
    {
        return $this->hasMany(Order::class, 'base_wallet_id')->where('side', '=', 'buy');
    }

    public function sellSystemOrders()
    {
        return $this->hasMany(SystemOrder::class, 'wallet_id')->where('side', '=', 'sell');
    }

    public function buySystemOrders()
    {
        return $this->hasMany(SystemOrder::class, 'base_wallet_id')->where('side', '=', 'buy');
    }

    public function getTotalFreezeAttribute()
    {
        // TODO::calculate freeze balance from mongo
        return addAmount( (string) $this->sell_freeze, (string) $this->buy_freeze);
    }
}
