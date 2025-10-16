@extends('layout')

@section('subtitle', 'Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <h3 class="text-center mb-4">Formulario de autenticación</h3>
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

        <form id='formulario' method='POST' action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
				<input 
                    type="email" 
                    class="form-control" 
                    name="email"  
                    value="{{ old('email') ?? null }}"
                >
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
			<div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    name="password"
					value="{{ old('password') ?? null }}" 
                >
                @error('password')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Checkbox recordar sesión -->
            <div class="mb-3 form-check">
                <input 
                    type="checkbox" 
                    class="form-check-input" 
                    id="remember" 
                    name="remember"
                    @checked(old('remember'))
                >
                <label class="form-check-label" for="remember">Recordar</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
            @error('login')
                <div class="alert alert-danger mt-3" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </form>
    </div>
</div>
@endsection
