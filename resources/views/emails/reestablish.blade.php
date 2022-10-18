@extends('front.layouts.auth.layout')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Перейдите по ссылке</h1>
        <div class="space-y-3">
            <a href="{{ route('reestablish.show') }}" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
               target="_blank" rel="noopener">{{ $url }}</a>
        </div>
    </div>
@endsection
