<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Website extends Controller {

	public $view;

	public function after()
	{
		if ($this->view)
		{
			$this->response->body($this->view);
		}

		return parent::after();
	}

} // End Website
