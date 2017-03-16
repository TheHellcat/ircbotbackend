<?php

namespace Hellcat\TwitchApiBundle\Twitch\Api;

/**
 * Class ApiConstants
 * @package Hellcat\TwitchApiBundle\Twitch\Api
 */
class ApiConstants
{
    const ENDPOINT_CHANNELS_GETCHANNEL = 'GET:/channel';
    const ENDPOINT_CHANNELS_GETCHANNELBYID = 'GET:/channels/{channelId}';
    const ENDPOINT_CHANNELS_UPDATECHANNEL = 'PUT:/channels/{channelId}';
    const ENDPOINT_CHANNELS_GETCHANNELEDITORS = 'GET:/channels/{channelId}/editors';
    const ENDPOINT_CHANNELS_GETCHANNELFOLLOWERS = 'GET:/channels/{channelId}/follows';
    const ENDPOINT_CHANNELS_GETCHANNELTEAMS = 'GET:/channels/{channelId}/teams';
    const ENDPOINT_CHANNELS_GETCHANNELSUBSCRIBERS = 'GET:/channels/{channelId}/subscriptions';
    const ENDPOINT_CHANNELS_CHECKCHANNELSUBSCRIPTIONBYUSER = 'GET:/channels/{channelId}/subscriptions/{userId}';
    const ENDPOINT_CHANNELS_GETCHANNELVIDEOS = 'GET:/channels/{channelId}/videos';
    const ENDPOINT_CHANNELS_STARTCHANNELCOMMERCIAL = 'POST:/channels/{channelId}/commercial';
    const ENDPOINT_CHANNELS_RESETCHANNELSTREAMKEY = 'DELETE:/channels/{channelId}/stream_key';
    const ENDPOINT_CHANNELS_GETCHANNELCOMMUNITY = 'GET:/channels/{channelId}/community';
    const ENDPOINT_CHANNELS_SETCHANNELCOMMUNITY = 'PUT:/channels/{channelId}/community/{communityId}';
    const ENDPOINT_CHANNELS_DELETECHANNELFROMCOMMUNITY = 'DELETE:/channels/{channelId}/community';
}
