<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Website {

	public function action_index()
	{
		$this->view = Kostache::factory('home')
			;
	}

}
