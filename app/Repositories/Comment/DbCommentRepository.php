<?php

namespace App\Repositories\Comment;

use App\Repositories\DbRepository;

class DbCommentRepository extends DbRepository implements CommentRepository {
	
	private $model;
	
	function __construct(Product $model){
		$this->model = $model;
	}
	
}

