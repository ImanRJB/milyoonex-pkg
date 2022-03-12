<?php

namespace Milyoonex\Observers;

use App\Models\Notification;
use Milyoonex\Jobs\NotificationJob;

class NotificationObserver
{
    public function created(Notification $notification)
    {
        try {
            dispatch(new NotificationJob($notification, $notification->getChanges(), 'store'));
        } catch (\Exception $exception) {

        }
    }

    public function updated(Notification $notification)
    {
        try {
            dispatch(new NotificationJob($notification, $notification->getChanges(), 'update'));
        } catch (\Exception $exception) {

        }
    }

    public function deleted(Notification $notification)
    {
        try {
            dispatch(new NotificationJob($notification, $notification->getChanges(), 'delete'));
        } catch (\Exception $exception) {

        }
    }

    public function restored(Notification $notification)
    {
        try {
            dispatch(new NotificationJob($notification, $notification->getChanges(), 'restore'));
        } catch (\Exception $exception) {

        }
    }

    public function forceDeleted(Notification $notification)
    {
        try {
            dispatch(new NotificationJob($notification, $notification->getChanges(), 'forceDelete'));
        } catch (\Exception $exception) {

        }
    }
}
