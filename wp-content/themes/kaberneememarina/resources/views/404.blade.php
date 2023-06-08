@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <p>
      {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
    </p>

    {!! get_search_form(false) !!}
  @endif
@endsection

@section('sidebar')
  @include('partials.sidebar')
@endsection
