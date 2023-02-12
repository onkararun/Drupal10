<?php

/**
 * @file
 * Contains Drupal\resume\LocalTasksService.
 */

namespace Drupal\resume;

class LocalTasksService {

	protected $resume_local_tasks = [];

	public function __construct() {
		$this->resume_local_tasks = [
			"0" => [
				"tab_name" => "resume.tab_1",
				"route_name" => "resume.form",
				"title" => "Resume",
				"base_route" => "resume.form",
				"weight" => "10"
			]
			"1" => [
				"tab_name" => "resume.tab_2",
				"route_name" => "work.form",
				"title" => "Work",
				"base_route" => "resume.form",
				"weight" => "20"
			]
			
		];
	}

	public function getValue() {
		return $this->resume_local_tasks;
	}

}