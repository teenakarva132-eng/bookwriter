<x-guest-layout>
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="bb_login_main_wrapper">        
        <div class="bb_login_flex">
            <div class="bb_login_left_img">
                <div class="bb_login_logo">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ __('logo') }}"></a>
                </div>
                <img src="{{asset('images/auth-img.svg')}}" alt="">
            </div>            
            <div class="bb_login_wrapper">
                <div class="bb_login_box">
                    <div class="bb_login_inner">                        
                        <div class="bb_login_header">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                        <div class="bb_login_input_field">
                            <div class="bb_login_input">                            
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter your email here..." :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12">
                                        <path class="cls-1"
                                            d="M1138.68,475h-12.36a1.354,1.354,0,0,0-1.32,1.385v9.23a1.356,1.356,0,0,0,1.32,1.385h12.36a1.352,1.352,0,0,0,1.32-1.385v-9.23A1.356,1.356,0,0,0,1138.68,475Zm-0.18.923-5.97,6.272-6.03-6.272h12Zm-12.62,9.5v-8.853l4.23,4.408Zm0.62,0.653,4.24-4.448,1.48,1.545a0.424,0.424,0,0,0,.62,0l1.45-1.519,4.21,4.424h-12Zm12.62-.653L1134.91,481l4.21-4.424v8.848Z"
                                            transform="translate(-1125 -475)" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="bb_forgot_btn">
                            <x-primary-button>
                                {{ __('Email Password Reset Link') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</form>
</x-guest-layout>
