<header class="banner sticky-top">
  <nav class="navbar navbar-expand-lg">
    <div class="container">

      @if(function_exists( 'the_msls' ))
        <div class="language-switcher">
          @php(the_msls())
        </div>
      @endif

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-menu"
              aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">@include('icon::menu')</span>
      </button>

      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav ml-auto', 'container_id' => 'primary-menu', 'container_class' => 'collapse navbar-collapse', 'echo' => false]) !!}
      @endif

    </div>
  </nav>
</header>
