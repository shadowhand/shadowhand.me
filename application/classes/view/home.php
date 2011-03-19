<?php defined('SYSPATH') or die('No direct script access.');

class View_Home extends Kostache {

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

	public function render()
	{
		$this->base    = Kohana::$base_url;
		$this->charset = Kohana::$charset;

		$this->environment = Kohana::$environment;
		$this->production  = (Kohana::$environment === Kohana::PRODUCTION);

		return parent::render();
	}

} // End Home
