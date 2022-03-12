<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milyoomex\Enum\DepositTypeEnum;
use App\Models\Wallet;
use App\Models\Network;

class Deposit extends Model
{
    use SoftDeletes;

    protected $table = 'deposits';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'type' => DepositTypeEnum::class
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
