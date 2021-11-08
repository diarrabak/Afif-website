@extends('layouts.app')

@section('content')

<main role="main" class="feature-main">

    <img class="event-img" src="/storage/images/{{ $service->picture  }}" alt='{{ $service->title }}' />

    <h1 class="event-title">{{$service->title}}</h1>

    <article class="row wrapper justify-content-center">
        <div class="event-info col-12 col-md-10">

            <h2 class="sr-only"> {{ $service->title }} </h2>
            <p class="card-description">{{$service->description}}</p>
        </div>

    </article>

</main>



@endsection