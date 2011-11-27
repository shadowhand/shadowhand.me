<?php defined('SYSPATH') or die('No direct script access.');

class Controller_About extends Controller_Website {

	public function action_index()
	{
		$this->view = Kostache::factory('about')
			;
	}

}
