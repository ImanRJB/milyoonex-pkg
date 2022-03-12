<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milyoomex\Enum\WithdrawalTypeEnum;
use App\Models\Wallet;
use App\Models\Network;

class Withdrawal extends Model
{
    use SoftDeletes;

    protected $table = 'withdrawals';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'type' => WithdrawalTypeEnum::class
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function network()
    {
        return $this->belongsTo(Network::class);
    }
}
