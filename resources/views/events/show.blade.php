@extends('layouts.app')

@section('content')

<main role="main" class="feature-main">

    <img class="event-img" src="/storage/images/{{ $event->picture  }}" alt='{{ $event->title }}' />

    <h1 class="event-title">{{$event->title}}</h1>

    <article class="row wrapper event-item justify-content-center">
        <h2 class="sr-only"> {{ $event->title }} </h2>
        <div class="card-date">
            <span>{{date('d',strtotime($event->date))}}</span>
            <span>{{date('M',strtotime($event->date))}}</span>
            <span>{{date('Y',strtotime($event->date))}}</span>
        </div>
        <div class="card-body">
            <p>{{date('l h:i:s A',strtotime($event->date))}}  Lieu : {{$event->place}}</p>
            <span> Organis&eacute; par {{$event->author}} </span>
        </div>

    </article>
    <div class="row wrapper mt-4">
        <h3> Description </h3>
        <p class="col-12 col-md-10 card-description">{{$event->description}}</p>
    </div>

</main>



@endsection