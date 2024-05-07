<x-app title="Inicio de sesion">
    <!-- Section: Design Block -->
    <section class="">
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Los mejores precios <br />
                            <span class="text-primary"> calidad para ti</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Nuestra aplicación de comercio electrónico es una solución ágil que se desarrollará
                            rápidamente para satisfacer tus necesidades
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card bg-table">
                            <div class="card-body py-5 px-md-5">
                                <form method="POST" action="{{ route('login') }} "
                                    class="d-flex flex-column align-content-center justify-content-center">
                                    @csrf
                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <h1 class="form-label w-100 text-center">{{ __('Iniciar sesion') }}</h1>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email input -->
                                    <div data-mdb-input-init class="form-outline mb-4 bg-input">
                                        <label class="form-label" for="email">
                                            <x-icons.emailicon />
                                            {{ __('Correo electrónico') }}
                                        </label>
                                        <input id="email" type="email"
                                            class="form-control bg-input @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autofocus
                                            placeholder="writeYourEmail@gmail.com" autocomplete="off">
                                        <!-- Deshabilitar autocompletado -->

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password input -->
                                    <div data-mdb-input-init class="form-outline mb-4 bg-input">
                                        <label class="form-label" for="form3Example4">
                                            <x-icons.passwordicon />
                                            {{ __('Contraseña') }}
                                        </label>
                                        <input id="password" type="password"
                                            class="form-control bg-input @error('password') is-invalid @enderror"
                                            name="password" required placeholder="*****" autocomplete="off">
                                        <!-- Deshabilitar autocompletado -->

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-start mb-4">
                                        <input class="form-check-input me-2" type="checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }} />
                                        <label class="form-check-label" for="remember">
                                            {{ __('Recordar credenciales') }}
                                        </label>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="col-sm-12 d-flex justify-content-start">

                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-custom btn-block mb-4">
                                            {{ __('Iniciar sesion') }}
                                        </button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu contrasena?') }}
                                        </a>
                                    @endif



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
</x-app>
