<?php

class TestController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$jobs = Job::all();
		$applicants = Applicant::all();
		$skills = Skill::all();
		$data = Array();
		$footer = Array();
		$footer['skills'] = Array();
		foreach($jobs as $j){
			$data[$j->id] = Array();
			$data[$j->id]['applicants'] = Array();
			$data[$j->id]['rowspan'] = 0;
			$data[$j->id]['name'] = $j->name;
		}
		foreach($applicants as $a){
			$app = new stdClass();
			$app->id = $a->id;
			$app->skills = Array();
			$app->name = $a->name;
			$app->email = $a->email;
			$app->website = $a->website;
			$app->cover_letter = $a->cover_letter;
			$app->job_id = $a->job_id;
			foreach($skills as $s){
				if($s->applicant_id == $a->id){
					array_push($app->skills, $s->name);
				}
				array_push($footer['skills'], $s->name);
			}
			$app->skillcount = count($app->skills);
			array_push($data[$app->job_id]['applicants'], $app);
			$data[$app->job_id]['rowspan'] += count($app->skills);
		}
		$footer['applicants'] = count($applicants);
		$footer['skills'] = count(array_unique($footer['skills']));
		return View::make('test', array('data' => $data,
                                                'footer' => $footer));
	}

}
