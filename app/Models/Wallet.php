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
use Illuminate\Support\Facades\Log;
use Milyoonex\Facades\MongoBaseRepositoryFacade;

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

    public function getMarketNameAttribute()
    {
        return $this->market->name;
    }

    public function getBuyFreezeAttribute()
    {
        $freeze = 0;
        foreach ($this->makeHidden('buyOrders')->buyOrders as $buyOrder) {
            $buyTable = str_replace(' ', '', strtolower(str_replace('/', '_', $buyOrder->market_name))) . '_order_buy';

            $buyOrders = MongoBaseRepositoryFacade::getRecords($buyTable, ['order_id' => $buyOrder->id]);
            foreach ($buyOrders as $buyOrder) {
                $remain = is_null($buyOrder['limit']) ? $buyOrder['value_remain'] : mulAmount($buyOrder['limit'], $buyOrder['remain']);
                $freeze = addAmount($freeze, $remain);

            }
        }
        return (string)$freeze;
    }

    public function getSellFreezeAttribute()
    {
        $freeze = 0;

        foreach ($this->makeHidden('sellOrders')->sellOrders as $sellOrder) {
            $sellTable = str_replace(' ', '', strtolower(str_replace('/', '_', $sellOrder->market_name))) . '_order_sell';
            $buyOrders = MongoBaseRepositoryFacade::getRecords($sellTable, ['order_id' => $sellOrder->id]);
            $freeze = addAmount($freeze, $buyOrders->sum('value_remain'));

        }


        return (string)$freeze;
    }

    public function getTotalFreezeAttribute()
    {
        return addAmount((string)$this->sell_freeze, (string)$this->buy_freeze);
    }


}
