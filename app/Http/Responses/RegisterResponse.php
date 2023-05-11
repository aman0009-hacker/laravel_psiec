<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Http\Responses\RegisterResponse as FortifyRegisterResponse;
use Illuminate\Support\Facades\DB;

class RegisterResponse extends FortifyRegisterResponse
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request)
    {
        $currentEmail=($request->input('email'));
        $currentId="";
        $currentConatct="";
        if(isset($currentEmail) && $currentEmail!="")
        {
        $data=DB::table('users')->where('email',$currentEmail)->first();
       
        $currentId=$data->id;$currentConatct=$data->contact_number;
       
        }
        // dd($currentId);
        //$this->guard->logout();
        //return parent::toResponse($request);
       
        if(isset($currentId) && !empty($currentId))
        {
        return redirect()->route('signUpSubmit')->with( ['data' => "success" , 'currentId'=> $currentId, 'contact_number'=>$currentConatct] );
        }         else {
            return redirect()->route('signUp')->with( ['data' => "notsuccess" , 'currentId'=> $currentId] );
        }
    }
}