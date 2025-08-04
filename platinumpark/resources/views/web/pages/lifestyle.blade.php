@extends('web.layouts.master')


@section('content')
<section class="banner-section">
    <div class="relative">
        <img src="{{ asset('assets/web/images/lifestyle/banner.png') }}" alt="">
        <div class="absolute">
            <div class="container">
                <h1>Lifestyle</h1>
                <p><a href="{{ route('home') }}">Home</a> <span>></span> Lifestyle</p>
            </div>
        </div>
    </div>
 </section>

 <section class="section-content content">
    <div class="container">
        <p>A select range of café and gourmet dining that make the perfect choice to unwind after productive hours of work, with more lifestyle-related retail stores opening soon.</p>

        <div class="row lifestyle-listing">
            <div class="col-12">
                <h3>DIRECTORY</h3>
            </div>
            @foreach ($lifestyle as $value)
                <div class="col-sm-4 col-12">
                    <a href="{{ route('lifestyle-detail', ['slug' => $value->slug]) }}">
                        <img src="{{ $value->thumbnail }}" alt="">
                        <p>{{ $value->title }}</p>
                    </a>
                </div> 
            @endforeach
        </div>

    </div>
 </section>

@endsection

