<?php defined('SYSPATH') or die('No direct script access.');

abstract class View_Layout extends Kostache_Layout {

	public $base = '/';

	public $charset = 'utf-8';

	public $environment = 'development';

	public $production = FALSE;

	public $php = PHP_VERSION;

	public function pledgie()
	{
		return array(
			'link' => 'http://www.pledgie.com/campaigns/14931',
			'image' => 'http://www.pledgie.com/campaigns/14931.png?skin_name=chrome',
		);
	}

	public function social()
	{
		return array(
			array(
				'name'  => 'twitter',
				'title' => 'Twitter',
				'link'  => 'http://twitter.com/shadowhand',
			),
			array(
				'name'  => 'google+',
				'title' => 'Google+',
				'link'  => 'http://plus.google.com/u/0/115222471649720738463/',
			),
			array(
				'name'  => 'linkedin',
				'title' => 'LinkedIn',
				'link'  => 'http://www.linkedin.com/pub/woody-gilk/4/946/824',
			),
			array(
				'name'  => 'flickr',
				'title' => 'Flickr',
				'link'  => 'http://www.flickr.com/photos/newood',
			),
			array(
				'name'  => 'lastfm',
				'title' => 'Last.fm',
				'link'  => 'http://last.fm/user/woodygilk',
			),
			array(
				'name'  => 'github',
				'title' => 'Github',
				'link'  => 'http://github.com/shadowhand',
			),
			array(
				'name'  => 'aboutdotme',
				'title' => 'About.me',
				'link'  => 'http://about.me/shadowhand',
			),
			// array(
			// 	'name'  => 'amazon',
			// 	'title' => 'Amazon',
			// 	'link'  => 'http://amzn.com/w/1474H3P2204L8',
			// ),
			array(
				'name'  => 'google-talk',
				'title' => 'Google Talk',
				'link'  => 'gtalk:chat?jid=woody.gilk@gmail.com',
			),
			array(
				'name'  => 'skype',
				'title' => 'Skype',
				'link'  => 'skype:woody.gilk?call',
			),
		);
	}

	public function menu()
	{
		$links = array(
			array(
				'link' => URL::site(),
				'title' => 'Home',
			),
			// array(
			// 	'link' => Route::url('about'),
			// 	'title' => 'About',
			// ),
			array(
				'link' => Route::url('projects'),
				'title' => 'Projects',
			)
		);

		$active = Request::current()->url();

		foreach ($links as $i => $data)
		{
			if ($data['link'] === $active)
			{
				$links[$i]['active'] = TRUE;
			}
		}

		return $links;
	}

	public function render()
	{
		$this->base    = Kohana::$base_url;
		$this->charset = Kohana::$charset;

		$this->production  = (Kohana::$environment === Kohana::PRODUCTION);
		$this->environment = $this->production ? 'live' : 'local';
		$this->kohana      = Kohana::VERSION;

		return parent::render();
	}

}
