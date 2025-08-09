@extends('web.layouts.master')


@section('content')
<section class="banner-section lifestyle-banner">
    <div class="container">
        <h1>{{ $wellness->title }}</h1>
        <p><a href="{{ route('home') }}">Home</a> <span>></span> <a href="{{ route('lifestyle') }}">Lifestyle</a><span>></span> {{ $wellness->title }}</p>
    </div>
        
 </section>

 <section class="section-content content lifestyle-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-7">
                @if ($wellness->description)
                    <p>{{ $wellness->description }}</p>
                @endif

                <br>

                @if ($wellness->menu)
                    <h3>MENU</h3>
                    <p><img src="{{ asset('assets/web/images/wellness/menu-1.png') }}" alt=""><a href="{{ asset($wellness->pdf ) }}"><i>{{ $wellness->menu }}</i></a></p>

                    @if ($wellness->menu2)
                        <p><img src="{{ asset('assets/web/images/wellness/menu-1.png') }}" alt=""><a href="{{ asset($wellness->pdf2 ) }}"><i>{{ $wellness->menu2 }}</i></a></p>
                    @endif
                @endif
                
                <br>


                @if ($wellness->operating_hours)
                    <h3>OPERATING HOURS</h3>
                    <p>{!! $wellness->operating_hours !!}</p>
                @endif
               
                <br>

                @if ($wellness->phone)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-1.png') }}" alt="">{!! $wellness->phone !!}</p>
                @endif

                @if ($wellness->website)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-2.png') }}" alt="">
                        <a target="_blank" href="https://{{ $wellness->website }}">{{ $wellness->website }}</a>
                    </p>
                @endif

                @if ($wellness->facebook)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-3.png') }}" alt="">
                        <a target="_blank" href="https://{{ $wellness->facebook }}">{{ $wellness->facebook }}</a>
                    </p>
                @endif

                @if ($wellness->instagram)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-4.png') }}" alt="">
                        <a target="_blank" href="https://{{ $wellness->instagram }}">{{ $wellness->instagram }}</a>
                    </p>
                @endif

                @if ($wellness->whatsapp)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-5.png') }}" alt="">
                        <a target="_blank" href="https://wa.me/{{ str_replace(' ', '', $wellness->whatsapp) }}">{{ $wellness->whatsapp }}</a>
                    </p>
                @endif

                @if ($wellness->twitter)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-7.png') }}" alt="">
                        <a target="_blank" href="https://{{ $wellness->twitter }}">{{ $wellness->twitter }}</a>
                    </p>
                @endif

                @if ($wellness->email)
                    <p><img src="{{ asset('assets/web/images/wellness/icon-6.png') }}" alt="">
                        <a target="_blank" href="mailto:{{ $wellness->email }}">{{ $wellness->email }}</a>
                    </p>
                @endif
                
                <br>

                @if ($wellness->book_email)
                    <p class="book-btn">
                        @if (strpos($wellness->book_email, '@') !== false) 
                            <a href="mailto:{{ $wellness->book_email }}">BOOK NOW</a>
                        @else
                            <a href="{{ $wellness->book_email }}">BOOK NOW</a>
                        @endif


                        @if ($wellness->event_email)
                            <a href="mailto:{{ $wellness->event_email }}">EVENT ENQUIRY</a>
                        @endif
                    </p>
                @endif
                
            </div>
            
            <div class="col-12 col-sm-5">
                @if($wellnessGallery != '[]')
                    <div class="lifestyle-gallery">
                        @foreach ($wellnessGallery as $value)
                            <a href="{{ asset($value->image_path) }}"><img src="{{ asset($value->image_path) }}" alt=""></a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
     

    </div>
 </section>

@endsection

