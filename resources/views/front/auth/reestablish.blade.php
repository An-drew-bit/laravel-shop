@extends('front.layouts.auth.layout')

@section('content')
    <div class="text-center">
        <a href="{{ route('home') }}" class="inline-block" rel="home">
            <img src="./images/logo.svg" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="Sublime.">
        </a>
    </div>

    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Восстановление пароля</h1>
        <form class="space-y-3" method="post" action="{{ route('reestablish.reestablish') }}">
            @csrf

            <input type="email" name="email"
                   class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                        @error('email')
                            _is-error focus:border-pink
                        @enderror"
                   placeholder="E-mail">
            @error('email')
                <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror
            <input type="password" name="password"
                   class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                        @error('password')
                            _is-error focus:border-pink
                        @enderror"
                   placeholder="Новый пароль">
            @error('password')
                <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirmation"
                   class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                        @error('password_confirmation')
                            _is-error focus:border-pink
                        @enderror"
                   placeholder="Повторите пароль">
            @error('password_confirmation')
                <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror
            <button type="submit" class="w-full btn btn-pink">Восстановить</button>
        </form>
    </div>
@endsection
