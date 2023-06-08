<div id="carousel-1" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    @foreach($carousel_items as $key => $item)
    <div class="carousel-item @if($key == 0)active @endif" style="background-image: url('{{$item["background"]}}')">
      <div class="carousel-caption">
        <h5>{{$item["title"]}}</h5>
        <p>{{$item["subtitle"]}}</p>
        <a class="carousel-bubble carousel-bubble-1 d-none d-xl-flex" href="{{$item["bubble_1"]["url"]}}">{{$item["bubble_1"]["title"]}}</a>
        <a class="carousel-bubble carousel-bubble-2 d-none d-xl-flex" href="{{$item["bubble_2"]["url"]}}">{{$item["bubble_2"]["title"]}}</a>
        <a class="carousel-bubble carousel-bubble-3 d-none d-xl-flex" href="{{$item["bubble_3"]["url"]}}">{{$item["bubble_3"]["title"]}}</a>
      </div>
    </div>
    @endforeach
  </div>

  @if(count($carousel_items) > 1)
    <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  @endif
</div>
