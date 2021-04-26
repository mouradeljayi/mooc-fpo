<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Module;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExamAdded extends Notification
{
    use Queueable;

    public $module;


    public function __construct(Module $module)
    {
        $this->module = $module;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'module' => $this->module,
        ];
    }
}
