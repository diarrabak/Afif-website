@extends('layouts.app')

@section('content')
<main role="main">
    <h1>Contactez-nous</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body contact">

                    <form action="{{route('send-email')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- <div class="card shadow"> -->

                        @if(session("emailStatus")=="success")
                        <div class="alert alert-success alert-dismissible"><button type="button" data-bs-dismiss="alert" aria-label="Close">&times;</button>Email envoye avec succ&egrave;s.</div>
                        @elseif(session("emailStatus")=="failed")
                        <div class="alert alert-warning alert-dismissible"><button type="button" data-bs-dismiss="alert" aria-label="Close">&times;</button>Email non envoy&eacute;.</div>
                        @elseif(session("emailStatus")=="error")
                        <div class="alert alert-danger alert-dismissible"><button type="button" data-bs-dismiss="alert" aria-label="Close">&times;</button>Email ne pouvait pas &ecirc;tre envoy&eacute;.</div>
                        @endif

                        <div class="form-group row">
                            <label for="senderName" class="col-md-4 col-form-label text-md-right">{{ __('Nom Prenom') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="senderName" id="senderName" class="form-control @error('senderName') is-invalid @enderror" value="{{ old('senderName') ?? '' }}" placeholder="Votre nom complet" required autofocus>

                                @error('senderName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="senderEmail" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input type="email" name="senderEmail" id="senderEmail" class="form-control @error('senderEmail') is-invalid @enderror" value="{{ old('senderEmail') ?? '' }}" placeholder="Votre email" required>
                                @error('senderEmail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emailSubject" class="col-md-4 col-form-label text-md-right">{{ __('Sujet') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="emailSubject" id="emailSubject" class="form-control @error('emailSubject') is-invalid @enderror" value="{{ old('emailSubject') ?? '' }}" placeholder="Sujet du message" required>
                                @error('emailSubject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emailBody" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <textarea name="emailBody" id="emailBody" class="form-control @error('emailBody') is-invalid @enderror"  placeholder="Votre message ici!" required>{{ old('emailBody') ?? '' }}</textarea>
                                @error('emailBody')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-4 offset-md-4">
                                <button type="submit" name="submit" class="btn btn-primary">Envoyer </button>
                            </div>
                        </div>
                        <!-- </div> -->
                    </form>
                </div>
            </div>

</main>
@endsection