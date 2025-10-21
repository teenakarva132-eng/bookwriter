<x-guest-layout>
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<!-- login page start -->
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="bb_login_main_wrapper">        
        <div class="bb_login_flex">
            <div class="bb_login_left_img">
                <div class="bb_login_logo">
                    <a href="{{url('/')}}"><img src="{{ asset('images/logo.png') }}" alt="{{ __('logo') }}"></a>
                </div>
                <img src="{{asset('images/auth-img.svg')}}" alt="{{ __('login vector') }}">
            </div>             
            <div class="bb_login_wrapper">
                <div class="bb_login_box">
                    <div class="bb_login_inner">                        
                        <div class="bb_login_header">
                            <h4>{{ __('Hello,') }}</h4>
                            <h2>{{ __('welcome back!') }}</h2>
                            <p>{{ __('please login to your account to continue.') }}</p>
                        </div>
                        <div class="bb_login_input_field">
                            <div class="bb_login_input">                        
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter email here..." :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12">
                                        <path class="cls-1"
                                            d="M1138.68,475h-12.36a1.354,1.354,0,0,0-1.32,1.385v9.23a1.356,1.356,0,0,0,1.32,1.385h12.36a1.352,1.352,0,0,0,1.32-1.385v-9.23A1.356,1.356,0,0,0,1138.68,475Zm-0.18.923-5.97,6.272-6.03-6.272h12Zm-12.62,9.5v-8.853l4.23,4.408Zm0.62,0.653,4.24-4.448,1.48,1.545a0.424,0.424,0,0,0,.62,0l1.45-1.519,4.21,4.424h-12Zm12.62-.653L1134.91,481l4.21-4.424v8.848Z"
                                            transform="translate(-1125 -475)" />
                                    </svg>
                                </span>
                            </div>
                            <div class="bb_login_input">                           
                            <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                placeholder="Enter password here..."
                                                required autocomplete="current-password" :value="old('password')" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15">
                                        <path class="cls-1"
                                            d="M1136.81,563.551a0.586,0.586,0,1,1-.58.586A0.583,0.583,0,0,1,1136.81,563.551Zm2.61,1.054a0.583,0.583,0,0,0,.58-0.586v-2.168a2.334,2.334,0,0,0-2.32-2.343h-0.7v-2.067a3.48,3.48,0,0,0-6.96,0v2.067h-0.7a2.334,2.334,0,0,0-2.32,2.343v4.8a2.334,2.334,0,0,0,2.32,2.344h8.36a2.334,2.334,0,0,0,2.32-2.344,0.58,0.58,0,1,0-1.16,0,1.167,1.167,0,0,1-1.16,1.172h-8.36a1.167,1.167,0,0,1-1.16-1.172v-4.8a1.166,1.166,0,0,1,1.16-1.171h8.36a1.166,1.166,0,0,1,1.16,1.171v2.168A0.583,0.583,0,0,0,1139.42,564.605Zm-3.6-5.1h-4.64v-2.067a2.321,2.321,0,0,1,4.64,0v2.067Zm-3.39,4.043a0.586,0.586,0,1,1-.58.586A0.583,0.583,0,0,1,1132.43,563.551Zm-2.18,0a0.586,0.586,0,1,1-.58.586A0.583,0.583,0,0,1,1130.25,563.551Zm4.35,0a0.586,0.586,0,1,1-.58.586A0.583,0.583,0,0,1,1134.6,563.551Z"
                                            transform="translate(-1127 -554)" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="bb_footer_field">
                        <label for="remember_me" class="inline-flex items-center bb_checkbox">
                            {{ __('Remember me') }}
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="bb_checkmark ms-2 text-sm text-gray-600"></span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        </div>
                        <div class="bb_login_btn">
                            <x-primary-button class="ms-3">
                                {{ __('Login now') }}
                            </x-primary-button>			
                        </div>
                        <div class="bb_register_line">
                            <p>{{ __('Don\'t Have An Account?') }}  <a href="{{ url('/register') }}">{{ __('Register Here') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</form>
<!-- login page end -->
</x-guest-layout>