@extends('layouts.app')

@section('content')

<main role="main" class="feature-main">
    <h1 class="main-title">Page personnelle de {{$user->name}}</h1>

    <article class="row wrapper justify-content-center">
        <div class="bio col-md-8 col-12">
            <img src="/storage/images/{{ $user->picture  }}" alt='Presentation de {{ $user->name }}' />
            <p class="biography"> {{ $user->biography }}</p>
        </div>

        <div class="col-md-8 col-12 publications">

            <h4 class="col-sm-12"> My research</h4>

            <p class="col-sm-12"><a href="mailto:{{$user->email}}" class="btn btn-primary">Contact me!</a></p>
        </div>
    </article>
</main>
@endsection