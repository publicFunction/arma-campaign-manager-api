<?php

namespace ARMACMan\Http\Controllers\Auth;


use ARMACMan\Repositories\UserRepository;
use ARMACMan\Models\User;
use ARMACMan\Http\Controllers\Controller;

use Dingo\Api\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    
    private $user_repo;
    
    public function __construct(UserRepository $userRepository) {
        $this->user_repo = $userRepository;
    }

    /**
     * Responsible for logging the user into the Application and with JWT
     * POST : {"email" : "email@example.com", "password" : "password"}
     * @param Request $request
     * @return mixed
     */
    public function auth(Request $request) {
        $auth_request = $request->all();

        if(!$this->validateAuth($auth_request)) {
            return response()->json(['status' => 'Forbidden', 'error' => 'Authorisation Request Invalid'], 403);
        }

        $user = $this->user_repo->getByEmail($auth_request['email']);
        if(null === $user) {
            return response()->json(['status' => 'Forbidden', 'error' => 'Authorisation Failed - User Does Not Exist'], 403);
        }

        if(\Auth::attempt($auth_request)) {
            try {
                if(! $token = JWTAuth::attempt($auth_request)) {
                    return response()->json(['status' => 'JWTAuth', 'error' => 'Authorisation Failed'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['status' => 'JWTException', 'error' => 'Token Generation Failed'], 401);
            }
            $payload = $this->createAuthPayload($user, $token);
            return response()->json($payload, 200);
        }
        return response()->json(['status' => 'JWTAuth', 'error' => 'Authorisation Failed'], 403);
    }

    public function me() {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['status' => 'Forbidden', 'error' => 'Authorisation Failed - User Does Not Exist'], 403);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Forbidden', 'error' => 'Authorisation Failed - User Does Not Exist'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'Forbidden', 'error' => 'Authorisation Failed - Token Invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['status' => 'Forbidden', 'error' => 'Authorisation Failed - Token Not Supplied'], $e->getStatusCode());
        }

        return response()->json(compact('user'), 200);
    }

    public function logout() {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['status' => 'Forbidden', 'error' =>'Authorisation Failed - User Does Not Exist'], 403);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Forbidden', 'error' =>'Authorisation Failed - User Does Not Exist'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'Forbidden', 'error' =>'Authorisation Failed - Token Invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['status' => 'Forbidden', 'error' =>'Authorisation Failed - Token Not Supplied'], $e->getStatusCode());
        }

        JWTAuth::parseToken()->invalidate();
        \Auth::logout();

        return response()->json(['status' => 'Success', 'error' => null, 'message' => 'Logged out'], 200);
    }

    private function createAuthPayload(User $user, $token) {
        $payload['user'] = $user;
        $payload['token'] = $token;
        return $payload;
    }

}
