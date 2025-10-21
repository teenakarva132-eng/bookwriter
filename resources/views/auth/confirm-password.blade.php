<x-guest-layout>
<form method="POST" action="{{ route('password.confirm') }}">
@csrf   
<div class="bb_login_main_wrapper">
        <div class="bb_login_wrapper">
            <div class="bb_login_box">
                <div class="bb_login_inner">
                    <div class="bb_login_logo">
                        <a href="{{url('/')}}"><img src="{{ asset('images/logo.png') }}" alt="{{ __('logo') }}"></a>
                    </div>
                    <div class="bb_login_header">
                       {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>
                    <div class="bb_login_input_field">
                        <div class="bb_login_input">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="bb_login_input">
                           <x-input-label for="password" :value="__('Password')" />
                           <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

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
                    <div class="bb_login_btn">
                        <x-primary-button>
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</x-guest-layout>
