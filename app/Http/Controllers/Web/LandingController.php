<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebController;

class LandingController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('welcome');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
