@extends('layouts.app')

@section('content')
<main role="main" class="feature-main">
    <dl class="row wrapper">

        <dt class="col-sm-3">Question</dt>
        <dd class="col-sm-9">{{ $faq->question }}</dd>

        <dt class="col-sm-3">Answer</dt>
        <dd class="col-sm-9">{!! $faq->answer !!}</dd>

    </dl>

</main>
@endsection