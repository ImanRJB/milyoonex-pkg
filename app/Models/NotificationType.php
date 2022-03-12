<?php

namespace Milyoonex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Notification;

class NotificationType extends Model
{
    use SoftDeletes;

    protected $table = 'notification_types';

    protected $hidden = [];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
