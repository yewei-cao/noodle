<?php
namespace App\Repositories;


abstract class DbRepository{
	
	private $model;
	
	function __construct($model){
		$this->model = $model;
	}
	
	public function getById($id){
		return $this->model->find($id);
	}
	
}