<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Models\UserSubscription;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $user_service;

    public function __construct(UserService $userService)
    {
        $this->user_service = $userService;
    }
    public function info($id)
    {
        return response()->json(['data'=>111],201);

    }

    public function register()
    {

        $userStoreRequest = new UserStoreRequest();
        $validator = Validator::make(request()->all(),$userStoreRequest->rules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 422);
        }

        try {
            $register = $this->user_service->store(request()->all());
            if (isset($register))
                return response()->json(['message'=>'Başarılı olarak kaydoldunuz'],201);
            else
                return response()->json(['message'=>'Başarılı olarak kaydolamadınız',404]);

        }catch (\Exception $e)
        {
            return response()->json(['message'=>'Doğrulama Başarısız',404]);
        }
    }
    public function login(UserLoginRequest $userLoginRequest)
    {
        if ($userLoginRequest->getErrorMessage() != [])
            return response()->json(['message' => $userLoginRequest->getErrorMessage()], 422);

        $login = Auth::attempt($userLoginRequest->all());
        if (Auth::check())
            return response()->json(['message'=>'Giriş Yaptınız'],202);
        else
            return response()->json(['message'=>'Giriş Bilgilerinizi Kontrol Ediniz'],204);


    }
}
