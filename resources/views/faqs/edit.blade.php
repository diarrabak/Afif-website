@extends('layouts.app')

@section('content')
<main role="main" class="feature-main">

    <h1>Editing number {{$faq->id}}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('faqs.update', ['faq' => $faq]) }}" method="POST">
                        @method('PUT')
                        @csrf


                        <div class="form-group row">
                            <label for="question" class="col-md-2 col-form-label text-md-right">{{ __('Question') }}</label>

                            <div class="col-md-8">
                                <textarea id="question" class="form-control @error('question') is-invalid @enderror" name="question" required autocomplete="question">{{ old('question') ?? $faq->question ??'' }} </textarea>

                                @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="answer" class="col-md-2 col-form-label text-md-right">{{ __('Answer') }}</label>

                            <div class="col-md-8">
                                <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" required autocomplete="answer">{{ old('answer') ?? $faq->answer ??'' }} </textarea>

                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="my-buttons form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update faq
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection