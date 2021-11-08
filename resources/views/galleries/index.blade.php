@extends('layouts.app')


@section('content')
<main role="main" class="feature-main">
    <div>
        <img class="header-img" src="/storage/images/homepage.jpg" alt='home' />
    </div>
    <h1 class="main-title">Les galleries</h1>

    @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
    <div class="wrapper">
        <a class="btn btn-primary" href="{{ route('galleries.create') }}" role="button">Ajouter un media</a>
    </div>
    @endif
    
    <div class="row wrapper justify-content-md-center">
        @if(count($images)>0)
        <h2> Les images </h2>
        @endif
        @forelse ($images as $gallery)

        <article class="card col-md-6 col-lg-4 col-xxl-3">
            <img class="card-img-top" src="/storage/images/{{ $gallery->picture}}" alt='Picture of {{$gallery->title}}' />
            <div class="card-body">

                <h3 aria-hidden="true" class="card-title"><a href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}"> {{ $gallery->title }} </a></h3>
                <p class="card-text">Lien: {{$gallery->link}}</p>
                <p class="card-text">Realise par : {{$gallery->author}}</p>
                <p class="card-description">{{$gallery->description}}</p>

                @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))

                <div class="row">
                    <!--a class="btn btn-success" href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}"> See more </a-->
                    <div class="col-6 offset-sm-2 col-sm-4">
                        <a class="btn btn-primary" href="{{ route('galleries.edit', ['gallery' => $gallery->id]) }}" alt="Edit" title="Edit">
                            Edit
                        </a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <form action="{{ route('galleries.destroy', ['gallery' => $gallery->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </article>


        @empty
        <p class="col-12 no-data">Pas d'images disponible pour l'instant!</p>
        @endforelse

    </div>

    <div class="row wrapper justify-content-md-center">

        @if(count($videos)>0)
        <h2> Les videos </h2>
        @endif

        @forelse ($videos as $gallery)


        <article class="card col-md-6 col-lg-4 col-xxl-3">
            <video controls>
                <source src="/storage/images/{{ $gallery->picture}}" type="video/mp4">
                <source src="/storage/images/{{ $gallery->picture}}" type="video/ogg">
                Votre navigateur ne prend pas en charge les vidéos HTML5. Vous pouvez les telecharger sur ce <a href="{{$gallery->link}}"> lien.</a>
            </video>

            <div class="card-body">

                <h3 aria-hidden="true" class="card-title"><a href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}"> {{ $gallery->title }} </a></h3>
                <p class="card-text">Realise par : {{$gallery->author}}</p>
                <p class="card-description">{{$gallery->description}}</p>

                @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
                <div class="row">
                    <!--a class="btn btn-success" href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}"> See more </a-->
                    <div class="col-6 offset-sm-2 col-sm-4">
                        <a class="btn btn-primary" href="{{ route('galleries.edit', ['gallery' => $gallery->id]) }}" alt="Edit" title="Edit">
                            Edit
                        </a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <form action="{{ route('galleries.destroy', ['gallery' => $gallery->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </article>


        @empty
        <p class="col-12 no-data">Pas de videos pour l'instant!</p>
        @endforelse

    </div>

    <div class="row wrapper justify-content-md-center">

        @if(count($audios)>0)
        <h2> Les sons audio </h2>
        @endif

        @forelse ($audios as $gallery)

        <article class="card col-md-6 col-lg-4 col-xxl-3">
            <audio controls>
                <source src="/storage/images/{{ $gallery->picture}}" type="audio/mpeg">
                <source src="/storage/images/{{ $gallery->picture}}" type="audio/ogg">
                Votre navigateur ne prend pas en charge les audios HTML5. Vous pouvez les telecharger sur ce <a href="{{$gallery->link}}"> lien.</a>
            </audio>

            <div class="card-body">

                <h3 aria-hidden="true" class="card-title"><a href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}"> {{ $gallery->title }} </a></h3>
                <p class="card-text">Realise par : {{$gallery->author}}</p>
                <p class="card-description">{{$gallery->description}}</p>

                @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
                <div class="row">
                    <!--a class="btn btn-success" href="{{ route('galleries.show', ['gallery' => $gallery->id]) }}"> See more </a-->
                    <div class="col-6 offset-sm-2 col-sm-4">
                        <a class="btn btn-primary" href="{{ route('galleries.edit', ['gallery' => $gallery->id]) }}" alt="Edit" title="Edit">
                            Edit
                        </a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <form action="{{ route('galleries.destroy', ['gallery' => $gallery->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </article>


        @empty
        <p class="col-12 no-data">Pas de sons audio pour l'instant!</p>
        @endforelse

    </div>
</main>
@endsection