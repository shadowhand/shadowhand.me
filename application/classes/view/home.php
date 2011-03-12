<?php defined('SYSPATH') or die('No direct script access.');

class View_Home extends Kostache {

	public $base = '/';

	public $charset = 'utf-8';

	public $environment = 'development';

	public $production = FALSE;

	public $php = PHP_VERSION;

	public function render()
	{
		$this->base    = Kohana::$base_url;
		$this->charset = Kohana::$charset;

		$this->environment = Kohana::$environment;
		$this->production  = (Kohana::$environment === Kohana::PRODUCTION);

		$this->env = print_r($_ENV, TRUE);

		return parent::render();
	}

} // End Home
