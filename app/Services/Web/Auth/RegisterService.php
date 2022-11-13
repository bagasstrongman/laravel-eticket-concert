<?php

namespace App\Services\Web\Auth;

use App\Services\WebService;

class RegisterService extends WebService
{
    /**
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        $this->userInterface->create($request);

        if (array_key_exists('password', $request)) {
            unset($request['password']);
        }

        activity('register')->withProperties($request)->log($request['username'].' berhasil di daftarkan');

        return true;
    }
}