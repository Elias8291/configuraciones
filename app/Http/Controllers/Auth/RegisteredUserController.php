<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredMail; // Asegúrate de importar el Mailable
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
class RegisteredUserController extends Controller
{
    
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * 
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'first_lastname' => ['required', 'string', 'max:255'],
                'second_last_name' => ['nullable', 'string', 'max:255'], // Note: fixed field name to match form
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'email_confirmation' => ['required', 'same:email'],
                'tipo_persona' => ['required', 'string', 'in:fisica,moral'],
                'rfc' => ['required', 'string', 'max:13'],
                'razon_social' => ['required', 'string'],
            ]);
            
            $password = $this->generateRandomPassword();
            $username = $this->generateUsername($request->name, $request->first_lastname);
            
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->first_lastname,
                'second_last_name' => $request->second_last_name,
                'email' => $request->email,
                'username' => $username,
                'password' => Hash::make($password),
                'status' => 'Activo',
                'rfc' => $request->rfc,
                'tipo_persona' => $request->tipo_persona,
                'razon_social' => $request->razon_social,
            ]);
            
            $this->sendRegistrationEmail($user, $username, $password);
            
            return redirect()->route('welcome')->with('success', 'Usuario registrado con éxito. Revisa tu correo electrónico para tu nombre de usuario y contraseña temporal.');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('register_tab', true); 
        }
    }
    private function generateRandomPassword(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        return substr(str_shuffle(str_repeat($characters, 10)), 0, 10);
    }

    /**
     * Generate a username based on the user's name and lastname.
     *
     * @param string $name
     * @param string $first_lastname
     * @return string
     */
    private function generateUsername($name, $first_lastname): string
    {
        $name = str_replace(' ', '', $name);
        $firstNameLetters = substr($name, 0, ceil(strlen($name) / 2));
        $lastNameLetters = substr($first_lastname, 0, 2);
        $randomNumbers = rand(100, 999);
        return strtolower($firstNameLetters . $lastNameLetters . $randomNumbers);
    }

    /**
     * Send registration email with username and password.
     *
     * @param \App\Models\User $user
     * @param string $username
     * @param string $password
     * @return void
     */
    private function sendRegistrationEmail(User $user, string $username, string $password): void
    {
        $data = [
            'name' => $user->name,
            'username' => $username,
            'password' => $password,
        ];
    
        Mail::send('emails.user_registered', $data, function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Registration Details');
        });
    }
}