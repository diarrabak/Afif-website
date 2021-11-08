@extends('layouts.app')


@section('content')
<main role="main" class="feature-main">

    <div>
        <img class="header-img" src="/storage/images/homepage.jpg" alt='home' />
    </div>

    <h1 class="main-title">Nos services</h1>

    @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
    <div class="wrapper">
        <a class="btn btn-primary" href="{{ route('services.create') }}" role="button">Ajouter un service</a>
    </div>
    @endif
    
    <div class="row wrapper justify-content-md-center">

        @forelse ($services as $service)

        <article class="card service col-lg-10 col-12">
            <div class="row service-item">
                <img src="/storage/images/{{ $service->picture  }}" alt='Picture of {{$service->title}}' />
                <div class="card-body">
                    <h3 aria-hidden="true" class="card-title"><a href="{{ route('services.show', ['service' => $service->id]) }}"> {{ $service->title }} </a></h3>
                    <p class="card-description">{{$service->description}}</p>
                </div>
            </div>
            @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))

            <div class="row mt-2">
                <div class="col-6 offset-sm-2 col-sm-4">
                    <a class="btn btn-primary" href="{{ route('services.edit', ['service' => $service->id]) }}" alt="Edit" title="Edit">
                        Edit
                    </a>
                </div>
                <div class="col-6 col-sm-4">
                    <form action="{{ route('services.destroy', ['service' => $service->id]) }}" method="POST">
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


</main>
@endsection