<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Exam;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReponseAdded extends Notification
{
    use Queueable;

    public $exam;

    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'exam' => $this->exam
        ];
    }
}
