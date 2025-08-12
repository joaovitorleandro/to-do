<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return $this->responseFail(
                'Erro de validação',
                422,
                422,
                [],
                $validator->errors()->toArray() 
            );
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = Auth::login($user);

        return $this->responseSuccess([
            'user' => $user,
            'token' => $token
        ], 'Usuário registrado com sucesso');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return $this->responseFail('Credenciais inválidas', 401);
        }

        return $this->responseSuccess([
            'user' => Auth::user(),
            'token' => $token
        ], 'Login realizado com sucesso');
    }

    public function logout()
    {
        Auth::logout();
        return $this->responseSuccess([], 'Logout realizado com sucesso');
    }
}   
