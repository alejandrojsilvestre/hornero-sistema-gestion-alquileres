@if (count($breadcrumbs))
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
    	<li class="m-nav__item m-nav__item--home">
			<a href="{{route('index')}}" class="m-nav__link m-nav__link--icon">
				<i class="m-nav__link-icon la la-home"></i>
			</a>
		</li>
		<li class="m-nav__separator"> - </li>
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="m-nav__item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="m-nav__item">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ul>

@endif