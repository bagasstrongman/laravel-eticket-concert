<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\WebController;
use App\Services\Web\Auth\LoginService;
use App\Http\Requests\Web\Auth\LoginRequest;

class LoginController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('pages.auth.login');
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
    public function store(LoginRequest $request, LoginService $service)
    {
        try {
            if ($service->store($request->validated())) {
                return to_route('dashboard.index');
            } else {
                return back();
            }
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
