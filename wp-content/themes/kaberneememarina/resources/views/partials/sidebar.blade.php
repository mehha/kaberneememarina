@php(dynamic_sidebar('sidebar-primary'))

<div class="sidebar-items row">
  <div class="col-sm-3 left">{!!$sidebar_image!!}</div>
  <div class="col-sm-9 right">
    @foreach($sidebar_items as $item)
      <div class="item">
        @if($item['icon'])
          @include('icon::'.$item['icon'])
        @endif
        @if($item['link'])
          <a href="{{$item['link']}}">{{$item['text']}}</a>
        @else
          <span>{{$item['text']}}</span>
        @endif
      </div>
    @endforeach
  </div>
</div>

@if($sidebar_link_1)
<a class="btn btn-secondary" href="{{$sidebar_link_1['url']}}">{{$sidebar_link_1['title']}}</a>
@endif

@if($sidebar_posts_title)
<h2 class="mehh-title">{{$sidebar_posts_title}}</h2>
@endif

<div class="sidebar-posts">
  @while($sidebar_posts->have_posts()) @php($sidebar_posts->the_post())
  @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile
</div>

@if($sidebar_link_2)
<a class="btn btn-secondary" href="{{$sidebar_link_2['url']}}">{{$sidebar_link_2['title']}}</a>
@endif
