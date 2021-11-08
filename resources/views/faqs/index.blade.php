@extends('layouts.app')




@section('content')

<main role="main" class="feature-main">
    <h1 class="main-title">Foire Aux Questions</h1>

    @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))

    <div class="wrapper">
        <a class="btn btn-primary" href="{{ route('faqs.create') }}" role="button">Add New faq</a>
    </div>

    @endif

    <div class="accordion accordion-flush row wrapper publications justify-content-center" id="accordionFlushExample">
        @forelse ($faqs as $faq)
        <div class="accordion-item col-md-8 col-sm-12">
            <div class="row mb-3">
                <h2 class="accordion-header col-12" id="flush-heading{{$faq->id}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$faq->id}}" aria-expanded="false" aria-controls="flush-collapse{{$faq->id}}">
                        {{ $faq->question }}
                    </button>
                </h2>
                <div id="flush-collapse{{$faq->id}}" class="accordion-collapse collapse col-12" aria-labelledby="flush-heading{{$faq->id}}" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">{!!$faq->answer!!}</div>
                </div>
            </div>

            @if(!empty(session('email')) && in_array(strtolower('admin'), session('roles')))
            <div class="row">
                <div class="offset-2 col-4 offset-md-4 col-md-2">
                    <a class="btn btn-primary" href="{{ route('faqs.edit', ['faq' => $faq->id]) }}" alt="Edit" title="Edit">
                        Edit
                    </a>
                </div>
                <div class="col-6">
                    <form action="{{ route('faqs.destroy', ['faq' => $faq->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">Delete</button>
                    </form>

                </div>
            </div>
            @endif
        </div>
        @empty

        <div class="no-data">
            No faqs available!
        </div>
        @endforelse


    </div>
</main>
@endsection