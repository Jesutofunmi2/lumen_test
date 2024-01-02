<?php

namespace App\Channels\Providers;

use Atymic\Twitter\Facade\Twitter;


class TwitterProvider extends BaseChannelProvider
{
    public function channelName(): string
    {
        return 'twitter';
    }

    public function subscribeToChatBot($userId)
    {
        Twitter::postFollow(['user_id' => $userId]); 
    }
}
