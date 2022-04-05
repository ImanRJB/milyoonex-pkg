<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Network;
use App\Models\Currency;

class WithdrawTrustedAddress extends Model
{
    use SoftDeletes;

    protected $table = 'withdraw_trusted_addresses';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function network()
    {
        return $this->belongsTo(Network::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
