# SMS1000 Notifications channel for Laravel 
This implementation is just for [sms10000](http://sms1000.ir/).

## How to install 

1. Add to service provider list (`config/app.php`)

```php

'providers' => [

...

\Sms1000\SmsChannelServiceProvider::class

...
...

]
```

2. add configuration (`config/services.php`)
```php

 'sms' => [
        'username' => env('SMS1000_USER'),
        'password' => env('SMS1000_PASSWORD'),
        'local' => 'farsi',
        'url' => 'https://sms1000.ir/url/send.aspx',
        'from' => env('SMS1000_FROM')
    ]

```

3.finally, add credential to your `.env` file

```text
SMS1000_USER=
SMS1000_PASSWORD=
SMS1000_FROM=
```

4. configure the Notifiable. you need to specify `routeNotificationForSms` function at your Notifiable method
```php
 /**
     * Route notification for sms
     *
     * @param \Illuminate\Notifications\Notification $notification
     * @return mixed
     */
    public function routeNotificationForSms($notification)
    {
        return $this->mobile;
    }
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

```php
use Sms1000\Channels\SmsChannel;
use Sms1000\Messages\SmsMessage;

class AccountApproved extends Notification
{
   /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SmsMessage
     */
    public function toSms($notifiable)
    {
        return  (new SmsMessage)
            ->content('put your text here')
            ->from(config('services.sms.from'));
            ->to(...)
    }
    
    
    ...
}
```

you can also use `toSms` function like below:

```php
  public function toSms($notifiable)
    {
        return  'your text here';
    }
```