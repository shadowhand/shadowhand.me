<?php defined('SYSPATH') or die('No direct script access.');

return array(

	// Group name, multiple configuration groups are supported
	'default' => array(

		// Multiple mechanisms can be added for versioned passwords, etc
		'mechanisms' => array(

			// crypt hashing
			'S2' => array('crypt', array(
				// Hash type to use
				'type' => 'sha256',
				'iterations' => 10000,
			)),

		),
	),
);
