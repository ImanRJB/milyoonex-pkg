<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CreditCard;
use App\Models\Wallet;

class IrtWithdrawal extends Model
{
    use SoftDeletes;

    protected $table = 'irt_withdrawals';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
