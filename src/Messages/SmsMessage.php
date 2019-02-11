<?php
declare(strict_types=1);

namespace Sms1000\Messages;


class SmsMessage
{

    /**
     * The phone number used to send message
     *
     * @var
     */
    public $from;

    /**
     * The content of message
     *
     * @var string
     */
    public $content;

    /**
     * The phone number of receiver
     *
     * @var string
     */
    public $to;

    /**
     * SmsMessage constructor.
     *
     * @param $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * @param  mixed $from
     * @return SmsMessage
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param  string $content
     * @return SmsMessage
     */
    public function content(string $content): SmsMessage
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param  $to
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;
        return $this;
    }


}