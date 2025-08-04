@extends('web.layouts.master')


@section('content')
<section class="banner-section lifestyle-banner">
    <div class="container">
        <h1>{{ $lifestyle->title }}</h1>
        <p><a href="{{ route('home') }}">Home</a> <span>></span> <a href="{{ route('lifestyle') }}">Lifestyle</a><span>></span> {{ $lifestyle->title }}</p>
    </div>
        
 </section>

 <section class="section-content content lifestyle-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-7">
                @if ($lifestyle->description)
                    <p>{{ $lifestyle->description }}</p>
                @endif

                <br>

                @if ($lifestyle->menu)
                    <h3>MENU</h3>
                    <p><img src="{{ asset('assets/web/images/lifestyle/menu-1.png') }}" alt=""><a href="{{ asset($lifestyle->pdf ) }}"><i>{{ $lifestyle->menu }}</i></a></p>

                    @if ($lifestyle->menu2)
                        <p><img src="{{ asset('assets/web/images/lifestyle/menu-1.png') }}" alt=""><a href="{{ asset($lifestyle->pdf2 ) }}"><i>{{ $lifestyle->menu2 }}</i></a></p>
                    @endif
                @endif
                
                <br>


                @if ($lifestyle->operating_hours)
                    <h3>OPERATING HOURS</h3>
                    <p>{!! $lifestyle->operating_hours !!}</p>
                @endif
               
                <br>

                @if ($lifestyle->phone)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-1.png') }}" alt="">{!! $lifestyle->phone !!}</p>
                @endif

                @if ($lifestyle->website)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-2.png') }}" alt="">
                        <a target="_blank" href="https://{{ $lifestyle->website }}">{{ $lifestyle->website }}</a>
                    </p>
                @endif

                @if ($lifestyle->facebook)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-3.png') }}" alt="">
                        <a target="_blank" href="https://{{ $lifestyle->facebook }}">{{ $lifestyle->facebook }}</a>
                    </p>
                @endif

                @if ($lifestyle->instagram)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-4.png') }}" alt="">
                        <a target="_blank" href="https://{{ $lifestyle->instagram }}">{{ $lifestyle->instagram }}</a>
                    </p>
                @endif

                @if ($lifestyle->whatsapp)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-5.png') }}" alt="">
                        <a target="_blank" href="https://wa.me/{{ str_replace(' ', '', $lifestyle->whatsapp) }}">{{ $lifestyle->whatsapp }}</a>
                    </p>
                @endif

                @if ($lifestyle->twitter)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-7.png') }}" alt="">
                        <a target="_blank" href="https://{{ $lifestyle->twitter }}">{{ $lifestyle->twitter }}</a>
                    </p>
                @endif

                @if ($lifestyle->email)
                    <p><img src="{{ asset('assets/web/images/lifestyle/icon-6.png') }}" alt="">
                        <a target="_blank" href="mailto:{{ $lifestyle->email }}">{{ $lifestyle->email }}</a>
                    </p>
                @endif
                
                <br>

                @if ($lifestyle->book_email)
                    <p class="book-btn">
                        @if (strpos($lifestyle->book_email, '@') !== false) 
                            <a href="mailto:{{ $lifestyle->book_email }}">BOOK NOW</a>
                        @else
                            <a href="{{ $lifestyle->book_email }}">BOOK NOW</a>
                        @endif


                        @if ($lifestyle->event_email)
                            <a href="mailto:{{ $lifestyle->event_email }}">EVENT ENQUIRY</a>
                        @endif
                    </p>
                @endif
                
            </div>
            
            <div class="col-12 col-sm-5">
                @if($lifestyleGallery != '[]')
                    <div class="lifestyle-gallery">
                        @foreach ($lifestyleGallery as $value)
                            <a href="{{ asset($value->image_path) }}"><img src="{{ asset($value->image_path) }}" alt=""></a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
     

    </div>
 </section>

@endsection

