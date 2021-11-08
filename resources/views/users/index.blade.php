@extends('layouts.app')


@section('content')
<main role="main" class="feature-main">
<h1 class="main-title">Nos membres</h1>
    @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))

    <div class="wrapper">
        <a class="btn btn-primary" href="{{ route('users.create') }}" role="button">Add New user</a>
    </div>

    @endif

   
    <div class="row wrapper justify-content-center">
        @forelse ($users as $user)

        <article class="card col-md-6 col-lg-4">
            <img class="card-img-top" src="/storage/images/{{ $user->picture  }}" alt='Picture of {{$user->name}}' />
            <div class="card-body">

                <h5 aria-hidden="true" class="card-title"><a href="{{ route('users.show', ['user' => $user->id]) }}"> {{ $user->name }} </a></h5>
                <p class="card-text">{{$user->title}}</p>

                @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
                <div class="row">
                    <!--a class="btn btn-success" href="{{ route('users.show', ['user' => $user->id]) }}"> See more </a-->
                    <div class="col-6 offset-sm-2 col-sm-4">
                        <a class="btn btn-primary" href="{{ route('users.edit', ['user' => $user->id]) }}" alt="Edit" title="Edit">
                            Edit
                        </a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
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
        <p class="col-12 no-data">No users in the table!</p>
        @endforelse
    </div>
</main>
@endsection