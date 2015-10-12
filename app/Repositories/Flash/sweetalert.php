<?php namespace App\Repositories\Flash;

use Illuminate\Support\Facades\Facade;

class sweetalert extends Facade {

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sweetalert';
    }

} 