<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\LogIngreso;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return "dni";
    }

    /**
     * Se ejecuta tras un login exitoso.
     */
    protected function authenticated(Request $request, $user)
    {
        LogIngreso::create([
            'user_id' => $user->id,
            'ip' => $request->ip(),
            'fecha' => now(),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
