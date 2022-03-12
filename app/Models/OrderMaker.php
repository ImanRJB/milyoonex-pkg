<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Currency;
use App\Models\Order;

class OrderMaker extends Model
{
    use SoftDeletes;

    protected $table = 'order_makers';

    protected $appends = [
        'type', 'candle_market_name', 'market_id', 'user_id'
    ];

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function feeCurrency()
    {
        return $this->belongsTo(Currency::class, 'fee_currency_id');
    }

    public function getTypeAttribute()
    {
        return 'maker';
    }

    public function getCandleMarketNameAttribute()
    {
        return strtolower(str_replace('/', '', $this->makeHidden('order')->order->market->name));
    }

    public function getMarketIdAttribute()
    {
        return $this->order->market->id;
    }

    public function getUserIdAttribute()
    {
        return $this->order->wallet->user_id;
    }
}
