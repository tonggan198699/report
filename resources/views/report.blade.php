@extends('app')

  @section('content')

  @if(session()->has('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
  @endif

  @if(session()->has('failure'))
  <div class="alert alert-danger">
      {{ session()->get('failure') }}
  </div>
  @endif

  @if($report)
      @include('htmlReport')
  @endif

  @endsection
