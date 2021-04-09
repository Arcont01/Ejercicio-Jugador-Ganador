<?php


namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     *
     */
    public function report()
    {

    }

    /**
     * @param $request
     * @return mixed
     */
    public function render($request)
    {
        return response()->view('home', ['exception' => $this]);
    }
}
