@extends('layouts.app')

@section('content')

<main role="main" class="feature-main">

    <img class="event-img" src="/storage/images/{{ $gallery->picture  }}" alt='{{ $gallery->title }}' />

    <h1 class="event-title">{{$gallery->title}}</h1>

    <article class="row wrapper justify-content-center">
        <div class="event-info col-12 col-md-10">

            <h2 class="sr-only"> {{ $gallery->title }} </h2>
            <p class="card-text">Author: {{$gallery->author}}</p>
            <p class="card-description">{{$gallery->description}}</p>
        </div>

    </article>

</main>



@endsection