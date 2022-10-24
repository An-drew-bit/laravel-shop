@extends('front.layouts.auth.layout')

@section('content')
    <div class="text-center">
        <a href="{{ route('home') }}" class="inline-block" rel="home">
            <img src="./images/logo.svg" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="Sublime.">
        </a>
    </div>

    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Регистрация</h1>
        <form class="space-y-3" method="post" action="{{ route('registered.store') }}">
            @csrf

            <input type="text" name="name"
                   class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                        @error('name')
                            _is-error focus:border-pink
                        @enderror"
                   placeholder="Имя и фамилия">
            @error('name')
                <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror
            <input type="email" name="email"
                   class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                        @error('email')
                            _is-error focus:border-pink
                        @enderror"
                   placeholder="E-mail">
            @error('email')
                <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
            @enderror
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <input type="password" name="password"
                           class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                               @error('password_confirmation')
                                    _is-error focus:border-pink
                               @enderror"
                           placeholder="Пароль">
                    @error('password')
                        <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="password" name="password_confirmation"
                           class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold
                               @error('password_confirmation')
                                    _is-error focus:border-pink
                               @enderror"
                           placeholder="Повторно пароль">
                    @error('password_confirmation')
                        <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="w-full btn btn-pink">Зарегистрироваться</button>
        </form>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">Есть аккаунт?
                <a href="{{ route('login') }}"
                   class="text-white hover:text-white/70 font-bold underline underline-offset-4">Войти</a>
            </div>
        </div>
        <ul class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20">
            <li>
                <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                   target="_blank" rel="noopener">Пользовательское соглашение</a>
            </li>
            <li class="hidden md:block">
                <div class="h-full w-[2px] bg-white/20"></div>
            </li>
            <li>
                <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                   target="_blank" rel="noopener">Политика конфиденциальности</a>
            </li>
        </ul>
    </div>
@endsection
