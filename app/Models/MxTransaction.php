<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milyoomex\Enum\MxTransactionTypeEnum;
use App\Models\Currency;

class MxTransaction extends Model
{
    use SoftDeletes;

    protected $table = 'mx_transactions';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'type' => MxTransactionTypeEnum::class
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}