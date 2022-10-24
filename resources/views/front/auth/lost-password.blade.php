@extends('front.layouts.auth.layout')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Восстановить пароль</h1>
        <form class="space-y-3" method="post" action="{{ route('forgot.update') }}">
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

            <x-forms.primary-button>Отправить</x-forms.primary-button>
        </form>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">
                <a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">Вспомнили или передумали?</a>
            </div>
        </div>

        @include('front.templates.politics')
    </div>
@endsection
