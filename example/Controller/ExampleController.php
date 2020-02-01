<?php 

namespace phprapidrest\example;

use phprapidrest\example\ExampleModel;

class ExampleController extends Controller{

	private $model;

	function __construct(){
		$this->model = new ExampleModel();
	}

	public function getAllUsers($query){
		return $this->model->getAllUsers($query);
	}

	public function getUserById($id){
		return $this->model->getUserById($id);
	}

	public function createUser($data){
		return $this->model->createUser($data);
	}

	public function updateUserById($id, $data){
		return $this->model->updateUserById($id, $data);
	}	

	public function deleteUserById($id){
		return $this->model->deleteUserById($id);
	}		
}