@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @if(Auth::check())
            @component('mail::header', ['url' => auth()->user()->sucursal->web ])
                {{ auth()->user()->sucursal->razon_social  }}
            @endcomponent
        @endif
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
        @if(Auth::check())
            @component('mail::footer')
                &copy; {{ date('Y') }} {{ auth()->user()->sucursal->razon_social  }}.
            @endcomponent
        @endif
    @endslot
@endcomponent
