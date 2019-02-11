<?php
declare(strict_types=1);

namespace Sms1000\Channels;

use Illuminate\Notifications\Notification;
use Sms1000\Client\SmsClient;
use Sms1000\Messages\SmsMessage;

class SmsChannel
{

    /**
     * @var SmsClient
     */
    private $sms;

    /**
     * SmsChannel constructor.
     *
     * @param SmsClient $smsClient
     */
    public function __construct(SmsClient $smsClient)
    {
        $this->sms = $smsClient;
    }

    /**
     * Send the given Notification
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     *
     * @return string
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }

        $message = $notification->toSms($notifiable);

        if (is_string($message)) {
            $message = new SmsMessage($message);
        }

        return $this->sms->send(
            [
                'from' => $message->from,
                'to' => $to ?? $message->to,
                'message' => trim($message->content)
            ]
        );


    }

}