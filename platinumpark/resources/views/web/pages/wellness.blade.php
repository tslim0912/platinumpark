@extends('web.layouts.master')


@section('content')
<section class="banner-section">
    <div class="relative">
        <img src="{{ asset('assets/web/images/wellness/banner.jpg') }}" alt="">
        <div class="absolute">
            <div class="container">
                <h1>Wellness</h1>
                <p><a href="{{ route('home') }}">Home</a> <span>></span> Wellness</p>
            </div>
        </div>
    </div>
 </section>

 <section class="section-content content">
    <div class="container">
        <p>A sanctuary of rejuvenation and balance, where mind and body find their natural rhythm.</p>

        <div class="row lifestyle-listing">
            <div class="col-12">
                <h3>DIRECTORY</h3>
            </div>
            @foreach ($wellness as $value)
                <div class="col-sm-4 col-12">
                    <a href="{{ route('wellness-detail', ['slug' => $value->slug]) }}">
                        <img src="{{ $value->thumbnail }}" alt="">
                        <p>{{ $value->title }}</p>
                    </a>
                </div> 
            @endforeach
        </div>

    </div>
 </section>

@endsection

