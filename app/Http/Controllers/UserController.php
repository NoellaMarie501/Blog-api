<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserController extends Controller
{
    /**
     * Repository object
     * 
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Registration Request
     *
     * @param  Request  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        $user = $this->userRepository->create($data);

        return response()->json(['user created' => $user], 200);
    }

    /**
     * Login Request
     *
     * @param  Request  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {

            $user = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (auth()->attempt($user)) {
                $user = $this->userRepository->findEmail($user['email']);
                $token = $user->createToken('Laravel Personal Access Client')->accessToken;
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'UnAuthorised'], 401);
            }
        } catch (Throwable $e) {
            return response()->json(['mesage' => $e->getMessage(), 'trace' => $e->getTrace(), 'error' => $e], 400);
        }
    }

    /**
     * Updates user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        try {
            $data = $request->only(['name', 'email', 'password']);
            $id = Auth::id();
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            $user = $this->userRepository->update($id, $data);
            return response()->json(['user' => $user], 200);
        } catch (Throwable $e) {
            return response()->json(['mesage' => $e->getMessage(), 'trace' => $e->getTrace(), 'error' => $e], 400);
        }
    }

    /**
     * Returns Authenticated User Record
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userRecord()
    {
        $user = $this->userRepository->find(Auth::id());
        //return var_dump('user', $user);
        return response()->json(['user' => $user], 200);
    }

    /**
     * Log out user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logOut(Request $request)
    {
        $user = $request->user();

        // Revoke all tokens for the user
        $tokens = $user->tokens;
        foreach ($tokens as $token) {
            $token->revoke();
        }

        return response()->json([
            'message' => 'Successfully logged out from all sessions'
        ]);
    }
}
