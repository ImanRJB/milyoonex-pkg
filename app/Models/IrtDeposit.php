<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milyoomex\Enum\IrtDepositStatusEnum;
use App\Models\Wallet;

class IrtDeposit extends Model
{
    use SoftDeletes;

    protected $table = 'irt_deposits';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'status' => IrtDepositStatusEnum::class
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
