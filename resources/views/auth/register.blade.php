<form method="POST" action="{{ route('register') }}" autocomplete="off">
    @csrf

    <!-- Primera Sección: Datos Personales -->
    <div id="section-1" class="section">
        <h3>Datos Personales</h3>
        <div class="row">
            <!-- Nombre Completo -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="off" />
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <!-- Primer Apellido -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="first_lastname">Primer Apellido</label>
                    <input id="first_lastname" class="form-control" type="text" name="first_lastname" value="{{ old('first_lastname') }}" required autocomplete="off" />

                    @if ($errors->has('first_lastname'))
                        <span class="text-danger">{{ $errors->first('first_lastname') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Segundo Apellido -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="second_lastname">Segundo Apellido</label>
                    <input id="second_lastname" class="form-control" type="text" name="second_last_name" value="{{ old('second_lastname') }}" autocomplete="off" />
                    @if ($errors->has('second_lastname'))
                        <span class="text-danger">{{ $errors->first('second_lastname') }}</span>
                    @endif
                </div>
            </div>

            <!-- Correo Electrónico -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="off" />
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <!-- Confirmar Correo Electrónico -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="email_confirmation">Confirmar Correo Electrónico</label>
                    <input id="email_confirmation" class="form-control" type="email" name="email_confirmation" value="{{ old('email_confirmation') }}" required autocomplete="off" />
                    @if ($errors->has('email_confirmation'))
                        <span class="text-danger">{{ $errors->first('email_confirmation') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Botón Siguiente -->
        <div class="d-flex justify-content-end">
            <button type="button" id="next-button" class="btn btn-primary">Siguiente</button>
        </div>
    </div>

    <!-- Segunda Sección: Datos de la Empresa -->
    <div id="section-2" class="section" style="display:none;">
        <h3>Datos de la Empresa</h3>
        <div class="row">
            <!-- Tipo de Persona -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="tipo_persona">Tipo de Persona</label>
                    <select id="tipo_persona" class="form-control" name="tipo_persona" required>
                        <option value="fisica">Persona Física</option>
                        <option value="moral">Persona Moral</option>
                    </select>
                </div>
            </div>

            <!-- RFC -->
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="rfc">RFC</label>
                    <input id="rfc" class="form-control" type="text" name="rfc" value="{{ old('rfc') }}" required autocomplete="off" maxlength="13" />
                    @if ($errors->has('rfc'))
                        <span class="text-danger">{{ $errors->first('rfc') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Razón Social -->
            <div class="col-12">
                <div class="form-group">
                    <label for="razon_social">Razón Social</label>
                    <textarea id="razon_social" class="form-control" name="razon_social" required autocomplete="off" rows="3">{{ old('razon_social') }}</textarea>
                    @if ($errors->has('razon_social'))
                        <span class="text-danger">{{ $errors->first('razon_social') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-between">
            <!-- Botón Anterior con flecha -->
            <button type="button" id="prev-button" class="btn btn-secondary mb-2 btn-sm custom-prev-button">
                <i class="fas fa-arrow-left"></i> Anterior
            </button>
        
            <!-- Botón Enviar -->
            <button type="submit" class="register-button w-100">Registrar</button>
            
        </div>
    </div>
</form>
