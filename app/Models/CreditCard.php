<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\IrtWithdrawal;
use App\Models\User;

class CreditCard extends Model
{
    use SoftDeletes;

    protected $table = 'credit_cards';

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

    public function irtWithdrawals()
    {
        return $this->hasMany(IrtWithdrawal::class);
    }
}
