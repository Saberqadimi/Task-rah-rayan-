<?php

namespace Modules\SmsSupport\Notifications\Api\V1;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\SmsSupport\Notifications\Api\V1\Channels\Sms20Channel as ChannelsSms20Channel;

class DetailSingleSmsNotification extends Notification
{
    use Queueable;

    protected $sender_number;

    protected $receiver_number;


    public function __construct($sender_number, $receiver_number)
    {
        $this->sender_number = $sender_number;
        $this->receiver_number = $receiver_number;
    }


    public function via($notifiable)
    {
        // dd(new ChannelsSms20Channel());
        return [ChannelsSms20Channel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toSms20Channel($notifiable)
    {
        return [
            'sender_number' => $this->sender_number,
            'receiver_number' => $this->receiver_number
        ];
    }
}
