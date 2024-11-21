<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        public UserRepository $userRepository,
    )
    {
    }

    public function signIn(array $data): JsonResponse
    {
        $name = $data["name"];
        $password = $data["password"];

        $user = $this->userRepository->findByName($name);

        if ($user && Hash::check($password, $user->password)) {

            auth()->loginUsingId($user->id, true);

            return response()->json([
                "status" => "success",
                "url"    => route("profile"),
            ]);
        }

        return response()->json([
            "status"  => "error",
            "message" => "invalid credentials",
        ], 500);
    }

    public function signUp(array $data): JsonResponse
    {
        $name = $data["name"];
        $password = $data["password"];

        $user = $this->userRepository->findByName($name);

        if ($user) {
            return response()->json([
                "status"  => "error",
                "message" => "Account already exists",
            ], 500);
        }

        $user = $this->userRepository->createUser($name, $password);

        auth()->loginUsingId($user->id, true);

        return response()->json([
            "status" => "success",
            "url"    => route("profile"),
        ]);
    }
}