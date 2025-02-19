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
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar el formulario de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Manejar la solicitud de registro de un nuevo usuario.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'first_lastname' => 'required|string|max:30',
            'second_lastname' => 'nullable|string|max:30',
            'email' => 'required|email|max:80|unique:users,email',
            'rfc' => 'required|string|max:13|unique:person_data,rfc',
            'razon_social' => 'required|string|max:200',
            'tipo_persona' => 'required|in:fisica,moral',
        ]);
    
        $password = $this->generateRandomPassword();
        $username = $this->generateUsername($request->name, $request->first_lastname);
    
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->first_lastname,
                'second_last_name' => $request->second_lastname,
                'email' => $request->email,
                'username' => $username,
                'password' => Hash::make($password),
                'status' => 'Activo',
            ]);
    
            $legalPersonValue = $request->tipo_persona === 'moral' ? '1' : null;
    
            \App\Models\PersonData::create([
                'user_id' => $user->id,
                'rfc' => $request->rfc,
                'legal_person' => $legalPersonValue,
                'business_name' => $request->razon_social,
                'status' => 'Pending',
            ]);
    
            DB::commit();
            return redirect()->route('welcome')->with('success', 'Usuario registrado con éxito. Revisa tu correo para ver tu nombre de usuario y contraseña temporal.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al registrar el usuario.'])->withInput();
        }
    }
    
    
    
    /**
     * Generar una contraseña aleatoria.
     *
     * @return string
     */
    private function generateRandomPassword(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }  
        return $password;
    }

    /**
     * Generar un nombre de usuario basado en el nombre y el apellido.
     *
     * @param string $name
     * @param string $first_lastname
     * @return string
     */
    private function generateUsername($name, $first_lastname): string
    {
        $name = str_replace(' ', '', $name);  // Eliminar espacios del nombre
        $firstNameLetters = substr($name, 0, ceil(strlen($name) / 2));  // Tomar la mitad del nombre
        $lastNameLetters = substr($first_lastname, 0, 2);  // Tomar las 2 primeras letras del apellido

        $randomNumbers = rand(100, 999);  // Generar 3 números aleatorios

        // Combinar las partes para crear el nombre de usuario
        return strtolower($firstNameLetters . $lastNameLetters . $randomNumbers);
    }

    /**
     * Enviar un correo de notificación al usuario con su nombre de usuario y contraseña.
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
    
        // Cambiar 'emails.registration' por 'emails.user_registered'
        Mail::send('emails.user_registered', $data, function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Detalles de Registro');
        });
    }
    
}
