<?php

/*
 * Global Flash functions.
 */
if ( ! function_exists('sweetalert_message')) {

	/**
	 * Arrange for a flash message.
	 *
	 * @param  string|null $message
	 * @return \Laracasts\Flash\FlashNotifier
	 */
 	function sweetalert_message($message = null,$title=null)
    {
    	$notifier = app('App\Repositories\Flash\sweetalert');
    	
    	if(func_num_args()==0){
    		return $notifier;
<<<<<<< HEAD
    	}
=======
    	}  	
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
    
    	return $notifier;
    }

<<<<<<< HEAD
}


if (! function_exists('access')) {
	/**
	 * Access (lol) the Access:: facade as a simple function
	 */
	function access()
	{
		return app('access');
	}
=======
>>>>>>> fb249198e8af973b9182767ce4a4d02a6f479aa8
}