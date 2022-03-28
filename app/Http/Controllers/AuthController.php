<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\RolPorUsuario;
use App\Models\Rol;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // $credentials = request(['email', 'password']);

        // if (!$token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);

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
            } catch (\Tymon\JWTAuth\Exceptions\JWTExceptios $e) {
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

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {


        try {
            $token = auth()->user(); //info del usuario, los campos mostrados estan en el modelo "user"

            $rolesPorUsuario[] = RolPorUsuario::where('idUsuario', $token->{'id'})->get(); //muestra los roles (solo los id´s)
            $contar = RolPorUsuario::where('idUsuario', $token->{'id'})->get()->count(); //cuenta rols hay cuantos son 

            //recopilacion de los roles del usuario
            for ($i = 0; $i < $contar; $i++) {
                $Rol[] = Rol::where('id', $rolesPorUsuario[0][$i]->{'idRol'})->get();
                $nombre[$i] = $Rol[$i][0]->{'nombre'};
            }

            return response()->json([
                'id' => $token->{'id'},
                'curp' => $token->{'curp'},
                'nombre' => $token->{'nombre'},
                'apellido1' => $token->{'apellido1'},
                'apellido2' => $token->{'apellido2'},
                'correo' => $token->{'email'},
                'roles' => $nombre,
                'estatus' => $token->{'status'}
            ]);

            //return response()->json(auth()->user());

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


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
        } catch (Exception $e) {
            return  $e->getMessage();
        }


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
        $validator = Validator::make($request->all(), [
            'curp' => 'required|string|max:18',
            'nombre' => 'required|string',
            'apellido1' => 'required|string',
            'apellido2' => 'string',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'status' => 'required|boolean'
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
            'user' => $user
        ], 201);
    }
}
