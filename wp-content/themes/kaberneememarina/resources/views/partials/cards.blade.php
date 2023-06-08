@if($cards)
  <div class="cards row">
    @foreach($cards as $key => $item)
      <div class="col-sm-6">
        <div class="card mb-3">
          <img class="card-img-top" src="{{$item["image"]}}" alt="Card image cap">
          <div class="card-body">
            <h3 class="card-title">{{$item["title"]}}</h3>
            <p class="card-text">{!!$item["content"]!!}</p>
            <a class="btn btn-secondary" href="{{$item["link"]["url"]}}" class="btn btn-primary">{{$item["link"]["title"]}}</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif
