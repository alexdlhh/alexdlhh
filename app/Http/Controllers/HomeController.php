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
    public function issueToken()
    {
        return '';
    }
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
        //comprobamos si este usuario tiene un token
        $api_token = $user->tokens()->where('name', 'my-token')->first();
        if (!$api_token) {
            $api_token = $user->createToken('my-token');
            $user->token = $api_token->accessToken;
            $user->save();
        }else{
            $api_token = ["accessToken"=>$user->token];//'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDkzMDMzZGYwN2VhNzdkNzg1MTZkMDM1OTI4N2ZiODcxNzcyNmUzMzZlZjdjMTA0ODA5ZjY3ZTljZmFiMjdmMTRjYWE2ODVhMzgwNmE5YzIiLCJpYXQiOjE3MDk0MDA4MDkuNTg5NzMyLCJuYmYiOjE3MDk0MDA4MDkuNTg5NzM2LCJleHAiOjE3NDA5MzY4MDkuNTM0OTYxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gy8nZY1A1XDLu929ksd83LsczIYOwXVom9cWdXDqJ-85UzWAB1SoUVbVm5dX8pP1PF9evg4c5CrtFrjsL1Fa--xotIja_AdNahRmsrGIFibB31RlAMq7oTDkPIwCoOW8WVAR4vyEzo44EghyEewhrfQXAQxQef2BucnpL3SdkDcUjD6MZrCfnbW1lwLJfH2g7H6WdnykTS2S2IeSwbcoKBXc8johsaOLv9z5qpuAF44DxY0KN_mLTVq8lvpUJacafcoH44Cjl1nXrHrWPCCkeuRjpx_4n7ilJLk2RGRy3WJP3PgbIPRRhk3ft1fHp57piH9WIQ2JtoDwfoALIbOit43LdyWRFnK1wcz23N1X4c2GZlW0hE8i-8MjhTfmrFVd9mP_UlTwuXCxUdHdEhCzDZcUEhXJdBOS-ZoqXueAIol69SvsJwYMyCUpqktRb9E22Zj8rTOX5wfaAzsQdikpmqQnc7qSNThG1CdFX3zdzN9HKXuCS00ZyzkeVCn_wcT74pS-0OSfZEjqW_FkTIeVEPBX9uDeOQLV_S8XnqDCZk7mvcTaqmcCwU0a9bGSrnUDD_JtQsmLSMqitHF0ZBr-ANBF-h4QQZ1xon7HU8RtIBjIOJrq6bXGZe1MlhaJ-zq_5q4AnGw0m6H_LpTxxZhyyUtfW4dR0qLQh1tFouqQvR8'];
            //transformamos el token en un objeto
            $api_token = (object) $api_token;
        }
        $metrics = file_get_contents('/var/www/public/metrics/metrics.json');
        $metrics = json_decode($metrics, true);
        $metrics=$metrics[$user->id];
        $metrics = json_encode($metrics);
        return view('admin.adminPanel', compact('user', 'api_token', 'metrics'));
    }

    public function ip(Request $request){
        $ip = $request->ipG;
        $fecha = date("Y-m-d H:i:s");
        $fp = fopen('access2.log', 'a');
        fwrite($fp, $ip . " - - [" . $fecha . "] " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'] . " " . $_SERVER['SERVER_PROTOCOL'] . "\n");
        fclose($fp);

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
