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
        \Log::error($this);
        return response()->make(view('home', ['errors' => $this->getMessage()]), 400);
    }
}
