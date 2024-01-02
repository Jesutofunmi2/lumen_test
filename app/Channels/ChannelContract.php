<?php 
namespace App\Channels;

interface ChannelContract 
{
    public function channelName();

    public function subscribeToChatBot($userId);
   
}