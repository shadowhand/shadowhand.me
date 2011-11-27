<?php defined('SYSPATH') or die('No direct script access.');

class View_About extends View_Layout {

	public function hello_at_shadowhand()
	{
		return HTML::mailto('hello@shadowhand.me');
	}

}
