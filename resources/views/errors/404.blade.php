@extends('layouts.errors.layout')

@section('content')
    <h1 class="text-2xl font-black text-center">{{ __('errors.404.error_404') }}</h1>
    <p class="max-w-[720px] mx-auto mt-4 text-body text-center">{{ __('errors.404.message') }}</p>
    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" class="btn btn-pink" rel="home">{{ __('errors.404.callback') }}</a>
    </div>
@endsection
