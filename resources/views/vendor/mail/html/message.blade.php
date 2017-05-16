@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <a href="http://instituteofcoaching.org" target="_blank">{{ config('app.name') }}</a>
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @if (isset($subcopy))
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endif

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} <a href="http://instituteofcoaching.org" target="_blank">{{ config('app.name') }}</a>. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
