<?php

namespace phprapidrest\example;

// use this run query to extract data from DB, use existing functions, ORM etc.

class ExampleModel extends Model{

	private $table      = 'users';
	private $dummy_data;

	function __construct(){
		$this->dummy_data = unserialize(file_get_contents(__DIR__ . '/' . $this->table . '.txt'));
	}

	function getAllUsers($query){

		return $this->dummy_data;
	}

	function getUserById($id){

		$user = FALSE;
		foreach ($this->dummy_data as $row) {
			if ($row['uid'] == $id){
				$user = $row;
				break;
			}
		}
		return $user;
	}

	function getNextId(){

		$last = end($this->dummy_data);
		return $last['uid'] + 1;
	}

	function createUser($data){

		$next = $this->getNextId();
		$this->dummy_data[] = [	'uid' => $next, 
							   	'username' => $data['username'],
								'email' => $data['email']
							];
		$this->saveTable();

		return $next;
	}

	function updateUserById($id, $data){

		foreach ($this->dummy_data as &$row) {
			if ($row['uid'] == $id){
				$row['username'] = $data['username'];
				$row['email']    = $data['email'];
				$this->saveTable();
				break;
			}
		}
		return TRUE;
	}

	function deleteUserById($id){

		foreach ($this->dummy_data as $key => $row) {
			if ($row['uid'] == $id){
				unset($this->dummy_data[$key]);
				$this->saveTable();
				return TRUE;
			}
		}
		return FALSE;
	}


	function saveTable(){
		file_put_contents(__DIR__ . '/' . $this->table . '.txt', serialize($this->dummy_data));
	}
}

