<?php

namespace Milyoonex\Repositories;

use App\Models\Notification;
use App\Models\NotificationType;

class NotificationRepository
{
    public static function getLastNotificationRecord($userId, $notificationTitle, $type = 'email')
    {
        $notificationTypeId = NotificationType::query()->where(['title' => $notificationTitle])->first()->id;
        if ($type == 'email')
            $notification = Notification::query()->where(['user_id' => $userId, 'notification_type_id' => $notificationTypeId, 'mobile' => null])->latest()->first();
        else if ($type == 'mobile')
            $notification = Notification::query()->where(['user_id' => $userId, 'notification_type_id' => $notificationTypeId, 'email' => null])->latest()->first();
        return $notification;
    }

    public static function createNotification($userId, $notificationTitle, $mobile = null, $email = null, $data = [])
    {
        $notificationTypeId = NotificationType::query()->where(['title' => $notificationTitle])->first()->id;

        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->notification_type_id = $notificationTypeId;
        $notification->mobile = $mobile;
        $notification->email = $email;
        if (!empty($data)) {
            $notification->data = json_encode($data);
        } else {
            $notification->data = null;
        }

        $notification->save();

        return $notification;

    }

}
