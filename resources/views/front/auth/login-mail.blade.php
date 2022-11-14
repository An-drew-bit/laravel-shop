@extends('layouts.auth.layout')

@section('title', 'Войти на сайт')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Вход в аккаунт</h1>
        <form class="space-y-3" method="post" action="{{ route('login.store') }}">
            @csrf

            <x-forms.text-input
                type="email"
                name="email"
                placeholder="E-mail"
                :isError="$errors->has('email')">
            </x-forms.text-input>

            @error('email')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input
                type="password"
                name="password"
                placeholder="Пароль"
                :isError="$errors->has('password')">
            </x-forms.text-input>

            @error('password')
                <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <div class="form-checkbox">
                <input type="checkbox" name="remember" id="filters-item-1">
                <label for="filters-item-1" class="form-checkbox-label">{{ __('auth.remember') }}</label>
            </div>

            <x-forms.primary-button>Войти</x-forms.primary-button>
        </form>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">
                <a href="{{ route('forgot') }}" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a>
            </div>
            <div class="text-xxs md:text-xs">
                <a href="{{ route('registered') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a>
            </div>
        </div>

        @include('front.templates.politics')
    </div>
@endsection
