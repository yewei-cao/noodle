<?php
namespace App\Repositories\Product;

use App\Repositories\DbRepository;

class DbProductRepository extends DbRepository implements ProductRepository{
	
	private $model;
	
	function __construct(Product $model){
		$this->model = $model;
	}
	
}