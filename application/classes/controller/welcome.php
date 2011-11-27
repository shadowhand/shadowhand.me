<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Website {

	public $demos = array();

	public function before()
	{
		$this->demos = array(
			'bonafide' => Route::url('demos', array('controller' => 'bonafide')),
			'apis'     => Route::url('demos', array('controller' => 'twitter')),
			'purifier' => Route::url('demos', array('controller' => 'purifier')),
			'uuid'     => Route::url('demos', array('controller' => 'uuid')),
		);

		return parent::before();
	}

	public function action_index()
	{
		$this->view = Kostache::factory('home')
			->bind('projects', $projects)
			;

		if ($projects = Kohana::cache('github.projects', NULL, Date::YEAR))
		{
			if ((time() - Arr::get($projects, 'when')) > Date::HOUR)
			{
				// Load a new project list after output
				register_shutdown_function(array($this, 'projects'));
			}
		}
		else
		{
			// Get the project list right now
			$projects = $this->projects(FALSE);
		}

		// Load up the project data
		$projects = json_decode($projects['data'])->repositories;

		foreach ($projects as & $project)
		{
			if (isset($this->demos[$project->name]))
			{
				$project->demo = $this->demos[$project->name];
			}
		}
	}

	public function projects($shutdown = TRUE)
	{
		try
		{
			$json = Request::factory('http://github.com/api/v2/json/repos/show/shadowhand')
				->execute()
				->body();

			$projects = array(
				'when' => time(),
				'data' => $json,
			);

			Kohana::cache('github.projects', $projects);

			if ($shutdown)
			{
				Kohana::$log->add(Log::INFO, 'Updated project list cache');
			}
		}
		catch (Exception $e)
		{
			if ( ! $shutdown)
			{
				throw $e;
			}

			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e));
		}
	}

} // End Welcome
