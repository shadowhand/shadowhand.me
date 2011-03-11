<?php defined('SYSPATH') or die('No direct script access.');

class View_Home extends Kostache {

	public $base = '/';

	public $charset = 'utf-8';

	public function render()
	{
		$this->base    = Kohana::$base_url;
		$this->charset = Kohana::$charset;

		return parent::render();
	}

} // End Home
