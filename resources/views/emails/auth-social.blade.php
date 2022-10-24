@extends('front.layouts.auth.layout')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Ваш временный пароль</h1>
        <div class="space-y-3">
            <p>Временный пароль для входа: {{ $password }}</p>
        </div>
    </div>
@endsection
