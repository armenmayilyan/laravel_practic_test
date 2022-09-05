<?php

namespace App\Http\Controllers;

use App\Events\OrderShipmentStatusUpdated;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\GetAuthUserResource;
use App\Models\Post;
use App\Models\User;
use App\Repository\UserRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    public function index()
    {
        return 'success';
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(RegisterRequest $request)
    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $this->userRepo->create($data);

        return response()->json(['success' => true]);

    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response()->json([
                'success' => 1,
                'user' => auth()->user(),
                'token' => $accessToken

            ]);


        } else {
            return response()->json(['success' => false]);
        }
    }

    public function getAuthUser(\Illuminate\Http\Request $request)
    {
        return new GetAuthUserResource(['success' => 1, 'auth' => Auth::user()]);
    }

    public function logout()
    {
        $token = auth()->user()->token('authToken');
        $token->revoke();
        return response()->json(['success' => true]);

    }


}
