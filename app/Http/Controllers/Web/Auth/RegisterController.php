<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\WebController;
use App\Services\Web\Auth\RegisterService;
use App\Http\Requests\Web\Auth\RegisterRequest;

class RegisterController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('pages.auth.register');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request, RegisterService $service)
    {
        try {
            $service->store($request->validated());
    
            return to_route('login.index');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
