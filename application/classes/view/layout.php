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
