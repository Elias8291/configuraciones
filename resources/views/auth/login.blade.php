<form id="login-form" method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf

    <!-- Username -->
    <div class="form-group">
        <label for="username">Nombre de Usuario</label>
        <input id="username" class="form-control" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="off" />
        @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
        @endif
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Contraseña</label>
        <div class="password-field">
            <!-- Cambié el id aquí a 'password' -->
            <input id="password" class="form-control" type="password" name="password" required autocomplete="off">
            <button type="button" class="toggle-password">
                <i class="fa fa-eye"></i>
            </button>
            
        </div>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <!-- Submit Button -->
    <button type="submit" class="login-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Iniciar Sesión
    </button>

    <!-- Forgot Password Link -->
    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
        @endif
    </div>
</form>

