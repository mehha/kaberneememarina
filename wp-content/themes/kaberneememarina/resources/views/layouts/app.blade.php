@include('partials.header')

@if(is_front_page())
  @include('partials.carousel')
@include('partials.frontpage.text-below-banner')
@endif

<div class="container content-wrap">
  <main class="main">
    @yield('content')
  </main>

  @hasSection('sidebar')
    <aside class="sidebar">
      @yield('sidebar')
    </aside>
  @endif
</div>

@include('partials.footer')
