@include('layouts.header')

    <div id="app">
        @include('layouts.navbar')

        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

@include('layouts.footer')