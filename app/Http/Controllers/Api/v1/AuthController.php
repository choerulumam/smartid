<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\File;
use App\Token;
use Illuminate\Http\Request;
use App\Mahasiswa;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'getMahasiswa']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        if (isset($request->Token)) {
            $token = new Token;
            if ($token->where('token', $request->Token)->first()) {
                $token->token = $request->Token;
                $token->save();
            } else {
                $token->create([
                    'token' => $request->Token
                ]);
            }

            File::put('plain' . '-' . date('Y-m-d H:i:s') . '.json', json_encode($request->all()));

            return response()->json(array('status' => 200, 'message' => 'success'));
        }

        File::put('plain' . '-' . date('Y-m-d H:i:s') . '.json', json_encode($request->all()));

        return response()->json(array('status' => 400, 'message' => 'failed'));
    }

    public function getMahasiswa()
    {
        $status  = 1;
        $message = "Success";
        $response = array();

        $mahasiswa = Mahasiswa::find(1);
        if ($mahasiswa) {
            $response = array(
                "status"  => $status,
                "message" => $message,
                'data'    => $mahasiswa
            );
        } else {
            $response = array(
                "status"  => 0,
                "message" => "failed",
                'data'    => $data
            );
        }

        return response()->json($response);
    }
}