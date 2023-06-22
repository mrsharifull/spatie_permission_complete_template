<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function message($type, $message)
    {
        if ($type == 'success') {
            Session::flash('success', $message);
        } elseif ($type == 'error') {
            Session::flash('error', $message);
        }
    }

    public function check_access($access){
        if(auth()->user()->can($access) || Auth::user()->role->id == 1){
            return true;
        }else{
            return abort(401);
        }

    }
}
