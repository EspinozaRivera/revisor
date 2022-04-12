<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\RolPorUsuario;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!$validator->fails()) {
            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'credenciales invalidas'
                    ]);
                }
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json([
                    'status' => false,
                    'error' => $e->getMessage(),
                    'message' => 'credenciales invalidas'
                ]);
            }

            return response()->json([
                'status' => true,
                'token' => compact('token'),
                'message' => 'credenciales validas'

            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function me()
    {
        try {
            $token = auth()->user(); //info del usuario, los campos mostrados estan en el modelo "user"

            // $rolesPorUsuario = RolPorUsuario::select('roles.id', 'roles.nombre')
            //     ->join('roles', 'rolesPorUsuario.idRol', '=', 'roles.id')
            //     ->where('rolesPorUsuario.idUsuario', $token->{'id'})
            //     ->get();

            return response()->json([
                'id' => $token->{'id'},
                'curp' => $token->{'curp'},
                'nombre' => $token->{'nombre'},
                'apellido1' => $token->{'apellido1'},
                'apellido2' => $token->{'apellido2'},
                'correo' => $token->{'email'},
                //'roles' => $rolesPorUsuario,
                'estatus' => $token->{'estatus'}
            ]);

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token expirado'
                ]);
            } else {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Token invalido'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Se requiere el token'
                    ]);
                }
            }
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

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
        $validator = Validator::make($request->all(), [
            'curp' => 'required|string|max:18',
            'nombre' => 'required|string',
            'apellido1' => 'required|string',
            'apellido2' => 'string',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'estatus' => 'required|boolean'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => '¡Usuario registrado exitosamente!',
            'user' => $user,
            'status' => true
        ], 201);
    }
}
