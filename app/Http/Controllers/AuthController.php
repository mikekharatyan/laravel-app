<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        public UserService $userService,
    )
    {
    }

    public function signIn(SignInRequest $request)
    {
        return $this->userService->signIn($request->validated());
    }

    public function signUp(SignUpRequest $request)
    {
        return $this->userService->signUp($request->validated());
    }

    public function logout()
    {
        auth()->logout();

        request()
            ->session()
            ->invalidate();

        request()
            ->session()
            ->regenerateToken();

        return redirect("/");
    }
}
