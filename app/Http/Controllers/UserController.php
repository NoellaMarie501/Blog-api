<?php

namespace App\Http\Controllers;

use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
use Throwable;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = $this->userService->registerUser($validatedData);

            return response()->json(['user created' => $user], 200);
        } catch (Throwable $e) {
            Log::error('Error registering user: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'data' => $request->all()
            ]);
            return response()->json(['message' => 'Failed to register user: '. $e->getMessage()], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            $token = $this->userService->loginUser($credentials);
            return response()->json(['token' => $token], 200);
        } catch (Throwable $e) {
            Log::error('Error logging in user: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'credentials' => $credentials
            ]);
            return response()->json(['message' => 'Failed to log in: '. $e->getMessage()], 401);
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $userId = Auth::id();

        try {
            $user = $this->userService->updatePassword($userId, $data);
            return response()->json(['user' => $user], 200);
        } catch (Throwable $e) {
            Log::error('Error updating password: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'data' => $data,
                'user_id' => $userId
            ]);
            return response()->json(['message' => 'Failed to update password: '. $e->getMessage()], 400);
        }
    }

    public function userRecord()
    {
        try {
            $userId = Auth::id();
            $user = $this->userService->getUserRecord($userId);

            return response()->json(['user' => $user], 200);
        } catch (Throwable $e) {
            Log::error('Error fetching user record: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'user_id' => Auth::id()
            ]);
            return response()->json(['message' => 'Could not get user record: '. $e->getMessage()], 400);
        }
    }

    public function logOut(Request $request)
    {
        try {
            $user = $request->user();

            $this->userService->logOutUser($user);

            return response()->json(['message' => 'Successfully logged out from all sessions']);
        } catch (Throwable $e) {
            Log::error('Error logging out user: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'user_id' => $request->user()->id
            ]);
            return response()->json(['message' => 'Failed to logout user: '. $e->getMessage()], 400);
        }
    }
}
