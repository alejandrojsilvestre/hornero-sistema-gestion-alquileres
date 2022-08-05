@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => auth()->user()->sucursal->web ])
            {{ auth()->user()->sucursal->razon_social  }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ auth()->user()->sucursal->razon_social }}.
        @endcomponent
    @endslot
@endcomponent
