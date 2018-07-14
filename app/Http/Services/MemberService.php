<?php

namespace App\Http\Services;

use App\User;
use App\Project;
/**
 * 
 */
class MemberService
{
	
	function __construct(User $user)
	{
		$this->user = $user;
	}

	public function detach($project, $user)
	{
		try {
			
			Project::whereSlug($project)->firstOrfail();


			dd($project, $user);

		} catch (Exception $e) {
			
		}
	}
}