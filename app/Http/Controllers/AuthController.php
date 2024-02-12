<?php

namespace App\Http\Controllers;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {
        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $credentials = $request->only(['password','email']);

           $token=  Auth::guard('admin_api')->attempt($credentials);
       if (!$token){

           return $this->returnError('E001','Invalid credentials');
       }else{

           $token_data = Auth::guard('admin_api')->user();
           $token_data->api_token=$token;
           return $this->returnData('data',$token_data);
       }

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }


    public function logout(Request $request)
    {
        $token=$request->auth_token;
        if ($token){

           try {
               JWTAuth::setToken($token)->invalidate();
               return $this->returnSuccessMassage('logout successful');
           }catch (JWTException $e){
               return $this->returnError('E001','some error occurred');



           }

        }else{

            return $this->returnError('E001','some error occurred');


        }
    }


    public function userLogin(Request $request){

//        return $request;

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $credentials = $request->only(['password','email']);

            $token=  Auth::guard('user_api')->attempt($credentials);
            if (!$token){

                return $this->returnError('E001','Invalid credentials');
            }else{

                $token_data = Auth::guard('user_api')->user();
                $token_data->api_token=$token;
                return $this->returnData('data',$token_data);
            }

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }



    }


}



