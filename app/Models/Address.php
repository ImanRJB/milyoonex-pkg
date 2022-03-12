<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AddressType;
use App\Models\User;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';

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

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }
}
