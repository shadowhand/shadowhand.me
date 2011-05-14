<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'twitter' => array(
		'key' => getenv('OAUTH_TWITTER_KEY'),
		'secret' => getenv('OAUTH_TWITTER_SECRET'),
	),
	'github' => array(
		'id' => getenv('OAUTH_GITHUB_ID'),
		'secret' => getenv('OAUTH_GITHUB_SECRET'),
	),
);
