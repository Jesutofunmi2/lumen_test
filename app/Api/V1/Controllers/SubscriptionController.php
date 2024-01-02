<?php

namespace App\Api\V1\Controllers;

use App\Channels\ChannelManager;
use App\Channels\Providers\BaseChannelProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SubscriptionController extends Controller
{
    protected BaseChannelProvider $provider;
    public function __construct(Request $request)
    {
        $channelManager = new ChannelManager();
        if ($request->get('channel')) {
            $this->provider = $channelManager->resolve($request->get('channel'));
        } else {
            $this->provider = $channelManager->defaultChannel();
        }
    }
    public function subscribeToChatBot(Request $request)
    {
        $userId = $request->header('user_id');

        if (is_null($userId)) {
            abort(400, 'user id is not provided');
        }
        try {
            $this->provider->subscribeToChatBot($userId);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
        return response()->json(['message' => 'User subscribed successfully']);
    }
}
