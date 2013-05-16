<?php
class AddCourse {

    function get($slug) {
        $validator = new Validator($_POST);
    	include('views/AddCourse.php');
    }
    function post($slug) {
    	// preprint($_POST);
        $validator = new Validator($_POST);

    	$validator
            ->required('This field is required.')
            ->validate('title');
		$validator
    		->required('This field is required.')
    		->callback('is_numeric', 'Please choose the right category.')
			->validate('category');

    	include('views/AddCourse.php');
    }
    function get_xhr($slug) {
    	// echo the json
    }
}

