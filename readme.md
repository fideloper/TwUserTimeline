# Twitter User Timeline

Really quick PHP script to get one specific user's timeline.

This complies with Twitter's API changes, which no longer allow unauthenticated calls to public timelines.

* Uses [simple file-cache](https://github.com/jonknee/JG_Cache) library to cache results, so high traffic sites don't hit the API rate limit
* "Borrows" Twitter oAuth code from [EE_Twitter](https://github.com/click-rain/EE_Twitter) ExpressionEngine add-on.

### Usage

See the `twitter.php` file at the root of this project for an example of usage. This is what it contains:

```php
<?php

require_once('library/twitteroauth.php');
require_once('library/Cache.php');

// EDIT to your needs
$cache = new Cache('/path/to/cache');

$data = $cache->get('tweets', 3600); // Cache for one-hour. This is in the "get" method in this implementation

// If cache expired or non-existent
if( $data === FALSE )
{
  // EDIT to your needs
  $settings = array(
		'consumer_key' => '',
		'consumer_secret' => '',
		'access_token' => '',
		'access_token_secret' => '',
	);

	$oauth = new TwitterEETwitter_OAuth($settings['consumer_key'], $settings['consumer_secret'], $settings['access_token'], $settings['access_token_secret']);
	$oauth->decode_json = FALSE;
  
  // EDIT the method call to your needs, based on Twitter's API
	$data = $oauth->get('statuses/user_timeline', array(
		'screen_name' => 'SOME_USER',
		'include_rts' => true,
		'exclude_replies' => true,
		'count' => 5
	));

	// Error checking first?
	$cache->set('tweets', $data);
}

// Output JSON
header('Content-Type: application/json');
echo $data;
```
