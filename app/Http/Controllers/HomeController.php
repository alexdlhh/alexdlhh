<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Muestra la vista de home
     * @return \Illuminate\View\View
     */
    public function home(){

        return view('home');
    }

    /**
     * Muestra la vista de login
     * @return \Illuminate\View\View
     */
    public function login(){
        // Si el usuario está autenticado, redirige a la vista principal del panel
        if (Auth::check()) {
            //dd(Auth::User());
            return redirect()->route('admin');
        }

        // Si el usuario no está autenticado, muestra la vista de login
        return view('auth.login');
    }

    /**
     * Autentica al usuario
     * @param Request $request
     * @return Response $response
     */
    public function do_login(Request $request){
        // Valida los datos del formulario de login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Redirige al usuario a la vista principal del panel
            return response()->json(['success' => Auth::User()->role], 200);
        }

        // Si la autenticación falla, muestra un error
        return response()->json(['error' => 'Los datos ingresados son incorrectos.'], 401);
    }

    /**
     * Cierra la sesión del usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        // Cierra la sesión del usuario
        Auth::logout();

        // Redirige al usuario a la vista de login
        return redirect()->route('login');
    }

    /**
     * Muestra la vista de registro
     * @return \Illuminate\View\View
     */
    public function register(){
        // Muestra la vista de registro
        return view('auth.register');
    }

    /**
     * Registra un nuevo usuario
     * @param Request $request
     * @return String $role
     */
    public function do_register(Request $request){
        // Valida los datos del formulario de registro
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        // Crea un nuevo usuario
        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->role = $request->role;
        $user->save();

        // Inicia sesión con el usuario recién creado
        Auth::login($user);

        // Redirige al usuario a la vista principal del panel
        return $user->role;
    }

    /**
     * Muestra la vista de dashboard
     * @return \Illuminate\View\View
     */
    public function dashboard(){
        $user = Auth::User();
        // Si el usuario no está autenticado, muestra la vista de login
        if (!$user) {
            return redirect()->route('login');
        }
        return view('admin.adminPanel', compact('user'));
    }

    /**
     * Muestra la vista de forgot
     * @return \Illuminate\View\View
     */
    public function forgot(){
        return view('forgot');
    }

    /**
     * Recupera la contraseña del usuario
     * @param Request $request
     */
    public function do_forgot(Request $request){
        // Valida los datos del formulario de recuperación de contraseña
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        // Busca al usuario por su correo electrónico
        $user = User::where('email', $credentials['email'])->first();

        // Si el usuario no existe, muestra un error
        if (!$user) {
            return response()->json(['error' => 'El correo electrónico ingresado no está registrado.'], 401);
        }

        // Genera un token de recuperación de contraseña
        $token = $user->createToken('password_reset')->plainTextToken;

        // Envia un correo electrónico con el token de recuperación de contraseña
        $user->sendPasswordResetNotification($token);

        // Muestra un mensaje de éxito
        return response()->json(['success' => 'Se ha enviado un correo electrónico con las instrucciones para recuperar tu contraseña.'], 200);
    }
}
