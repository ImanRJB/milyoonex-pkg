<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milyoonex\Enum\CurrencyTypeEnum;
use App\Models\Wallet;
use App\Models\Market;
use App\Models\Network;
use App\Models\MxTransaction;
use App\Models\OrderMaker;
use App\Models\OrderTaker;
use App\Models\ReferralReward;
use App\Models\WithdrawTrustedAddress;

class Currency extends Model
{
    use SoftDeletes;

    protected $table = 'currencies';

    protected $hidden = [
        'wallet_id'
    ];

    protected $guarded = [
        'id',
        'wallet_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'type' => CurrencyTypeEnum::class,
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function markets()
    {
        return $this->hasMany(Market::class, 'currency_id');
    }

    public function baseMarkets()
    {
        return $this->hasMany(Market::class, 'base_currency_id');
    }

    public function networks()
    {
        return $this->belongsToMany(Network::class)
            ->withPivot([
                'deposit_status', 'withdrawal_status',
                'mx_balance', 'contract', 'decimal', 'withdrawal_fee'
            ]);
    }

    public function mxTransactions()
    {
        return $this->hasMany(MxTransaction::class);
    }

    public function orderMakers()
    {
        return $this->hasMany(OrderMaker::class, 'fee_currency_id');
    }

    public function orderTakers()
    {
        return $this->hasMany(OrderTaker::class, 'fee_currency_id');
    }

    public function referralReward()
    {
        return $this->hasMany(ReferralReward::class, 'currency_id');
    }

    public function withdrawTrustedAddreses()
    {
        return $this->hasMany(WithdrawTrustedAddress::class);
    }
}
