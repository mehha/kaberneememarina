@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <p>
      {!! __('Sorry, no results were found.', 'sage') !!}
    </p>

    {!! get_search_form(false) !!}
  @endif

  @while(have_posts()) @php(the_post())
    @include('partials.content-search')
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('partials.sidebar')
@endsection
