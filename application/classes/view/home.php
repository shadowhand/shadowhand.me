<?php defined('SYSPATH') or die('No direct script access.');

class View_Home extends Kostache {

	public $base = '/';

	public $charset = 'utf-8';

	public $production = FALSE;

	public function render()
	{
		$this->base    = Kohana::$base_url;
		$this->charset = Kohana::$charset;

		$this->production = (Kohana::$environment === Kohana::PRODUCTION);

		return parent::render();
	}

} // End Home
