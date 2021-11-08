@extends('layouts.app')

@section('content')
<main role="main" class="feature-main">
    <h1>Merci beaucoup {{session('emailSender')}} </h1>
    <div class="wrapper thank-message">
        <p>Votre message a ete bien recu par notre equipe.</p>
        <p>Nous ferons tout notre possible pour vous donner une reponse d'ici trois jours maximum.</p>
    </div>
</main>
@endsection