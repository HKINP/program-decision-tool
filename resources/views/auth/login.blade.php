<x-authentication-layout>
   
<div class="border border-gray-300 rounded-lg p-6 ">
       
<h1 class="text-base text-white align-left dark:text-gray-100 font-bold mb-6">Sign In</h1>
        
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif   

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4 text-left ">
                <div>
                    <label for="email" class="block text-white text-sm ">Username or Email</label>
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />                
                </div>
                <div>
                    <label for="password" class="block text-white text-base text-sm ">Password</label>
                    <x-input id="password" type="password" name="password" required autocomplete="current-password" />                
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <div class="mr-1">
                        <a class="text-sm text-white underline hover:no-underline" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>
                @endif            
                <x-button class="ml-3 bg-[#7a4183]">
                    {{ __('Sign in') }}
                </x-button>            
            </div>
        </form>
        <x-validation-errors class="mt-4" />  
    </div>
</x-authentication-layout>
