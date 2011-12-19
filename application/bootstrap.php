<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

//-- Configuration and initialization -----------------------------------------

if ($env = getenv('KOHANA_ENV'))
{
	// Set Kohana::$environment if 'KOHANA_ENV' has been supplied
	Kohana::$environment = constant('Kohana::'.strtoupper($env));
}

/**
 * Define the current application version.
 */
define('APP_VERSION', '2.0.0');

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
	'index_file' => FALSE,
));

/**
 * Write logs when adding items.
 */
Log::$write_on_add = TRUE;

/**
 * Signed cookie salt.
 */
Cookie::$salt = 'v,8mnGqBt}gbays?NX2L';

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'env'        => MODPATH.'env',        // Configuration from $_ENV
	'demos'      => MODPATH.'demo',         // Module demos
	'bonafide'   => MODPATH.'bonafide',   // Bonafide authentication
	// 'database'   => MODPATH.'database',   // Database access
	'email'      => MODPATH.'email',      // Emailer
	'kostache'   => MODPATH.'kostache',   // Mustache templates
	'uuid'       => MODPATH.'uuid',       // Universally Unique Identifiers
	'oauth'      => MODPATH.'oauth',      // OAuth Authentication
	'openid'     => MODPATH.'openid',     // OpenID Authentication
	'twitter'    => MODPATH.'apis/twitter', // Twitter
	'github'     => MODPATH.'apis/github',  // Github
	'mailchimp'  => MODPATH.'mailchimp',  // MailChimp
	'purifier'   => MODPATH.'purifier',     // HTML Purifier
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('about', 'about')
	->defaults(array(
		'controller' => 'about',
	));

Route::set('projects', 'projects(/<action>)')
	->defaults(array(
		'controller' => 'projects',
	));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'about',
	));
