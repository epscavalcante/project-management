<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProjectService;
class MemberController extends Controller
{
    function __construct(ProjectService $projectService)
    {
    	$this->projectService = $projectService;
    }

    public function destroy($project, $member)
    {
    	$response = $this->projectService->detach($project, $member);

    	if($response['status']){
    		toast($response['message'], 'success', 'top-right');
    	}else{
    		toast($response['message'], 'error', 'top-right');
    	}

    	return back();
    }
}
