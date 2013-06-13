<?php

// Cache: https://github.com/jonknee/JG_Cache (Modified to simply be named "cache")
// Twitter oAuth: https://github.com/click-rain/EE_Twitter (Libraries "borrowed", I think just as EE_Twitter's author did)

require_once('library/twitteroauth.php');
require_once('library/Cache.php');

$cache = new Cache('/path/to/cache');

$data = $cache->get('tweets', 3600); // Cache for one-hour. This is in the "get" method in this implementation

if( $data === FALSE )
{
	$settings = array(
		'consumer_key' => '',
		'consumer_secret' => '',
		'access_token' => '',
		'access_token_secret' => '',
	);

	$oauth = new TwitterEETwitter_OAuth($settings['consumer_key'], $settings['consumer_secret'], $settings['access_token'], $settings['access_token_secret']);
	$oauth->decode_json = FALSE;
	$data = $oauth->get('statuses/user_timeline', array(
		'screen_name' => 'SOME_USER',
		'include_rts' => true,
		'exclude_replies' => true,
		'count' => 5
	));

	// Error checking first?
	$cache->set('tweets', $data);
}

header('Content-Type: application/json');
echo $data;
