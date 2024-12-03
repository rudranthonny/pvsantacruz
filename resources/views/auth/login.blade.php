<x-guest-layout>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <div class="image-container">

            </div>
          </div>
          
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-center">
                    <div class="imagen_jack">

                    </div>
                  </div>

                  <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0">Or</p>
                  </div>
                  <div class="col-12">
                    <x-validation-errors class="mb-4" style="color: red;"/>
                </div>
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" />
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="vform-check mb-0">
                        <x-checkbox id="remember_me" name="remember" />
                      <label for="remember_me" class="flex items-center">
                       Recuerdame
                      </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-body" href="{{ route('password.request') }}">
                            {{ __('Olvidaste la contraseña') }}
                        </a>
                    @endif
                  </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <x-button class="ml-4">
                            {{ __('Ingresar') }}
                        </x-button>
                    </div>
            </form>
          </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 footer-container">
    <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0 text-center" >
          <b>J-NETWORK © 2024.</b>
        </div>
    </div>
</x-guest-layout>
