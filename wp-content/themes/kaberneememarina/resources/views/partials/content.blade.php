<article @php(post_class())>
  <div class="post-meta">
    <h4 class="entry-title">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h4>

    @include('partials/entry-meta')
  </div>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
