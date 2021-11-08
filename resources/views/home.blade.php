@extends('layouts.app')

@section('content')
<main role="main">
    <!-- <div>
        <img class="home-img" src="/storage/images/homepage.jpg" alt='home' />
    </div> -->

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="/storage/images/assos.jpg" class="d-block w-100 home-img" alt="...">
                <div class="carousel-caption">
                    <h5>Accueil et orientation des familles.</h5>
                    <!-- <p>Some representative placeholder content for the third slide.</p> -->
                </div>
            </div>
            <div class="carousel-item active">
                <img src="/storage/images/homepage.jpg" class="d-block w-100 home-img" alt="...">
                <div class="carousel-caption">
                    <h5>Faciliter l'integration des nouveaux arrivants.</h5>
                    <!-- <p>Some representative placeholder content for the first slide.</p> -->
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/images/familypic.jpg" class="d-block w-100 home-img" alt="...">
                <div class="carousel-caption">
                    <h5>Promouvoir la langue francais en Ontario</h5>
                    <!-- <p>Some representative placeholder content for the second slide.</p> -->
                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <h1 class="sr-only home-title"> Bienvenue sur le site de l'AFIF</h1>
    <!-- <p class="afif-definition">Association Des Femmes Immigrantes Francophones Cornwall-Sdg</p> -->
    <div class="home-banner row">
        <div class="offset-sm-3 col-4">
            <a href="{{ route('payment') }}" class="btn btn-success">Pay $100 from Paypal</a>
        </div>
        <div class="col-4">
            <a href="{{route('contact')}}" class="btn btn-success">Devenez volontaire</a>
        </div>
    </div>

    <div class="row wrapper call-volunteer">
        <div class="col-md-6">
            <span>Pourquoi devenir volontaire?</span>
            <h2>Votre aide fera une grande difference a la vie de plusieurs beneficiaires.</h2>
        </div>
        <div class="col-md-6">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, saepe beatae blanditiis iure optio aliquid aliquam iusto ut
                voluptatibus, nulla, vero autem natus assumenda eius nesciunt corporis ex dolorum quia?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim porro magni consectetur labore. Ut ipsam nostrum vero ipsum,
                facilis non doloribus illo exercitationem minima, consequatur, placeat quod rerum nihil esse.</p>
        </div>
    </div>

    <!-- Page 2  -->
    <div class="page wrapper">
        <div class="row justify-content-md-center">

            @forelse ($services as $service)

            <article class="card col-md-6 col-lg-4 col-xxl-3 mt-4">
                <h3 class="sr-only">Les services que nous rendons</h3>
                <img class="card-img-top service-img" src="/storage/images/{{ $service->picture  }}" alt='Picture of {{$service->title}}' />
                <div class="card-body">
                    <h3 aria-hidden="true" class="card-title"><a href="{{ route('services.show', ['service' => $service->id]) }}"> {{ $service->title }} </a></h3>
                </div>
            </article>

            @empty
            <p class="col-12 no-data">Pas d'evenements a venir pour l'instant!</p>
            @endforelse

        </div>
    </div>
    <!-- Page 3  -->
    <div class="event-bg">
        <div class="page wrapper">
            <div class="row justify-content-md-center">

                <h2 class="page-title"> Les &eacute;venements a venir </h2>

                @forelse ($events as $event)

                <article class="card col-md-6 col-lg-4">
                    <h2 class="col-12 sr-only"> {{ $event->title }} </h2>
                    <div class="row">
                        <div class="col-12">
                            <img class="card-img-top" src="/storage/images/{{ $event->picture  }}" alt='{{ $event->title }}' />
                        </div>
                        <div id="event-item" class="col-12">
                            <div class="event-date">
                                <span>{{date('d',strtotime($event->date))}}</span>
                                <span>{{date('M',strtotime($event->date))}}</span>
                                <span>{{date('Y',strtotime($event->date))}}</span>
                            </div>
                            <div class="event-place">
                                <p>{{date('l h:i:s A',strtotime($event->date))}}</p>
                                <h3><a href="{{ route('events.show', ['event' => $event->id]) }}"> {{ $event->title }} </a></h3>
                            </div>
                        </div>
                    </div>

                </article>


                @empty
                <p class="col-12 no-data">Pas d'evenements a venir pour l'instant!</p>
                @endforelse

            </div>
        </div>
    </div>
    <!-- Page 4  -->
    <div class="testimonial-bg">
        <div class="page wrapper">
            <div id="carouselTestimonialCaptions" class="carousel slide" data-bs-ride="carousel">
                <h2 class="sr-only page-title"> Temoignages des utilisateurs </h2>
                <div class="carousel-inner row">
                    @forelse ($testimonials as $testimonial)
                    @if($loop->iteration==1)
                    <article class="active carousel-item">

                        <div class="testimonial offset-md-2 col-md-8 col-sm-12">
                            <h4>{{$testimonial->title}}</h4>
                            <p> {{$testimonial->comment}}</p>
                            <img class="rounded-circle" src="/storage/images/{{ $testimonial->picture  }}" alt='{{ $testimonial->picture  }}' />

                            <h5 class="card-title"> {{ $testimonial->name }} </h5>
                        </div>

                    </article>
                    @else
                    <article class="carousel-item">

                        <div class="testimonial  offset-md-2 col-md-8 col-sm-12">
                            <h4>{{$testimonial->title}}</h4>
                            <p> {{$testimonial->comment}}</p>
                            <img class="rounded-circle" src="/storage/images/{{ $testimonial->picture  }}" alt='{{ $testimonial->picture  }}' />
                            <h5 class="card-title"> {{ $testimonial->name }} </h5>
                        </div>

                    </article>
                    @endif

                    @empty
                    <p class="col-12 no-data">No testimonials available!</p>
                    @endforelse
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonialCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonialCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

</main>
@endsection