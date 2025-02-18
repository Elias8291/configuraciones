<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredMail; // Asegúrate de importar el Mailable
use Spatie\Permission\Traits\HasRoles;
class UserController extends Controller
{
    use HasRoles;
    /**
     * Handle the registration form submission and store the user data.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
  
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'first_lastname' => 'required|string|max:255',
            'second_lastname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
    
        // Si la validación falla, redirige con errores
        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Generar una contraseña aleatoria
        $password = $this->generateRandomPassword();
    
        // Generar el nombre de usuario
        $username = $this->generateUsername($request->name, $request->first_lastname);
    
        // Crear el nuevo usuario
        User::create([
            'name' => $request->name,
            'first_lastname' => $request->first_lastname,
            'second_lastname' => $request->second_lastname,
            'email' => $request->email,
            'username' => $username,
            'password' => Hash::make($password), // Encriptar la contraseña
            'status' => 'Activo', // Estado predeterminado
        ]);
    
        // Enviar el correo con el nombre de usuario y la contraseña
        Mail::to($request->email)->send(new UserRegisteredMail($username, $password));

        // Redirigir con mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario registrado con éxito. Revisa tu correo para ver tu nombre de usuario y contraseña temporal.');
    }

    /**
     * Generar una contraseña aleatoria.
     *
     * @return string
     */
    private function generateRandomPassword()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < 10; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }

    /**
     * Generar un username basado en el nombre y apellido.
     *
     * @param string $name
     * @param string $first_lastname
     * @return string
     */
    private function generateUsername($name, $first_lastname)
    {
        $name = str_replace(' ', '', $name);  // Eliminar espacios del nombre
        $firstNameLetters = substr($name, 0, ceil(strlen($name) / 2));  // Tomar la mitad del nombre
        $lastNameLetters = substr($first_lastname, 0, 2);  // Tomar las 2 primeras letras del apellido

        $randomNumbers = rand(100, 999);  // Generar 3 números aleatorios

        // Combinar las partes para crear el username
        return strtolower($firstNameLetters . $lastNameLetters . $randomNumbers);
    }
}
