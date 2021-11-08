@extends('layouts.app')


@section('content')
<main role="main" class="feature-main">

    <div>
        <img class="header-img" src="/storage/images/homepage.jpg" alt='home' />
    </div>
    <h1 class="main-title">Liste des evenements</h1>

    @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
    <div class="wrapper">
        <a class="btn btn-primary" href="{{ route('events.create') }}" role="button">Leave a event</a>
    </div>
    @endif
    
    <div class="row wrapper justify-content-md-center">
        <h2> Les evenements a venir </h2>
        @forelse ($futureEvents as $event)

        <article class="card event col-lg-10 col-12">
            <div class="event-item row">
                <div class="card-date">
                    <span>{{date('d',strtotime($event->date))}}</span>
                    <span>{{date('M',strtotime($event->date))}}</span>
                    <span>{{date('y',strtotime($event->date))}}</span>
                </div>
                <div class="card-body">
                    <span>{{date('l h:i:s A',strtotime($event->date))}} Lieu : {{$event->place}}</span>
                    <h3 aria-hidden="true" class="card-title"><a href="{{ route('events.show', ['event' => $event->id]) }}"> {{ $event->title }} </a></h3>
                    <span> Organis&eacute; par {{$event->author}} </span>
                </div>
            </div>
            @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
            <div class="row">
                <!--a class="btn btn-success" href="{{ route('events.show', ['event' => $event->id]) }}"> See more </a-->
                <div class="col-6 offset-sm-2 col-sm-4">
                    <a class="btn btn-primary" href="{{ route('events.edit', ['event' => $event->id]) }}" alt="Edit" title="Edit">
                        Edit
                    </a>
                </div>
                <div class="col-6 col-sm-4">
                    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                    </form>
                </div>
            </div>
            @endif

        </article>


        @empty
        <p class="col-12 no-data">Pas d'evenements a venir pour l'instant!</p>
        @endforelse

    </div>

    <div class="row wrapper justify-content-md-center">
        <h2> Les evenements passes </h2>
        @forelse ($pastEvents as $event)

        <article class="card event col-lg-10 col-12">
            <div class="row event-item">
                <div class="card-date">
                    <span>{{date('d',strtotime($event->date))}}</span>
                    <span>{{date('M',strtotime($event->date))}}</span> <!-- F for full name and m for number form -->
                    <span>{{date('Y',strtotime($event->date))}}</span>
                </div>
                <div class="card-body">
                    <span>{{date('l h:i:s A',strtotime($event->date))}} Lieu : {{$event->place}}</span>
                    <h3 aria-hidden="true" class="card-title"><a href="{{ route('events.show', ['event' => $event->id]) }}"> {{ $event->title }} </a></h3>
                    <span> Organis&eacute; par {{$event->author}} </span>
                </div>
            </div>
            @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
            <div class="row">
                <!--a class="btn btn-success" href="{{ route('events.show', ['event' => $event->id]) }}"> See more </a-->
                <div class="col-6 offset-sm-2 col-sm-4">
                    <a class="btn btn-primary" href="{{ route('events.edit', ['event' => $event->id]) }}" alt="Edit" title="Edit">
                        Edit
                    </a>
                </div>
                <div class="col-6 col-sm-4">
                    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                    </form>
                </div>
            </div>
            @endif

        </article>

        @empty
        <p class="col-12 no-data">Pas d'evenements passes!</p>
        @endforelse

    </div>
</main>
@endsection