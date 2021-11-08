@extends('layouts.app')


@section('content')
<main role="main" class="feature-main">

    <div>
        <img class="header-img" src="/storage/images/homepage.jpg" alt='home' />
    </div>

    <h1 class="main-title">Temoignages de quelques personnes</h1>

    <div class="wrapper">
        <a class="btn btn-primary" href="{{ route('testimonials.create') }}" role="button">Leave a testimonial</a>
    </div>

    <div class="row wrapper justify-content-md-center">

        @forelse ($testimonials as $testimonial)


        <article class="col-md-8 col-sm-12">

            <div class="testimonial rounded justify-content-center">
                <h4>{{$testimonial->title}}</h4>
                <p> {{$testimonial->comment}}</p>
                <img class="rounded-circle" src="/storage/images/{{ $testimonial->picture  }}" alt='{{ $testimonial->picture  }}' />
                <!-- <h5 class="card-title"><a href="{{ route('testimonials.show', ['testimonial' => $testimonial->id]) }}"> {{ $testimonial->name }} </a></h5> -->
                <h5 class="card-title"> {{ $testimonial->name }} </h5>
            </div>
            @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
            <div class="row justify-content-around">

                <div class="col-4 offset-2 col-sm-2 offset-sm-4">
                    <a class="btn btn-primary" href="{{ route('testimonials.edit', ['testimonial' => $testimonial->id]) }}" alt="Edit" title="Edit">
                        Edit
                    </a>
                </div>

                <div class="col-5 col-md-5 offset-md-1">
                    <form action="{{ route('testimonials.destroy', ['testimonial' => $testimonial->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                    </form>
                </div>
            </div>

            @endif

        </article>


        @empty
        <p class="col-12 no-data">No testimonials available!</p>
        @endforelse

    </div>
</main>
@endsection