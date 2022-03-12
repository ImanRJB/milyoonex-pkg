<?php

namespace Milyoonex\Jobs;

use App\Facades\NotificationFacade;
use App\Jobs\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;

class NotificationJob extends Job
{
    use Queueable;

    private $model;
    private $method;
    private $changes;

    public function __construct($model, $changes, $method)
    {
        $this->onQueue('mx_notification');
        $this->model = $model;
        $this->method = $method;
        $this->changes = $changes;
    }

    public function handle()
    {
        try {
            switch ($this->method) {
                case 'store':
                    NotificationFacade::createdNotification($this->model, $this->changes);
                    break;
                case 'update':
                    NotificationFacade::updatedNotification($this->model, $this->changes);
                    break;
                case 'delete':
                    NotificationFacade::deletedNotification($this->model, $this->changes);
                    break;
                case 'restore':
                    NotificationFacade::restoredNotification($this->model, $this->changes);
                    break;
                case 'forceDelete':
                    NotificationFacade::forceDeletedNotification($this->model, $this->changes);
                    break;
            }
        } catch (\Exception $exception) {
            Log::info('Error Notification Job!');
        }
    }
}
