<?php

declare(strict_types=1);

namespace Sms1000;

use Illuminate\Support\ServiceProvider;
use Sms1000\Channels\SmsChannel;
use Sms1000\Client\SmsClient;

class SmsChannelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(SmsChannel::class)
            ->needs(SmsClient::class)
            ->give(
                function () {
                    return new SmsClient(
                        config('services.sms.username'),
                        config('services.sms.password'),
                        config('services.sms.local')
                    );
                }
            );
    }

}