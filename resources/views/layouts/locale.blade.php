@php $langs = ['en', 'ru', 'am'] @endphp

<div class="flags-box mx-auto">
    @foreach($langs as $lang)

        <a href="{{ route('locale', ['locale' => $lang]) }}">
            @if($locale === $lang)
                <img src="{{ asset('storage/flags/' . $lang . '.png') }}" alt="flag" class="img-fluid selected-flag">
            @else 
                <img src="{{ asset('storage/flags/' . $lang . '.png') }}" alt="flag" class="img-fluid">
            @endif
        </a>

    @endforeach
</div>
