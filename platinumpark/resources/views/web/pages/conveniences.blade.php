@extends('web.layouts.master')


@section('content')
<section class="banner-section">
    <div class="relative">
        <img src="{{ asset('assets/web/images/conveniences/banner.png') }}" alt="">
        <div class="absolute">
            <div class="container">
                <h1>Conveniences</h1>
                <p><a href="{{ route('home') }}">Home</a> <span>></span> Conveniences</p>
            </div>
        </div>
    </div>
 </section>

 <section class="section-content content">
    <div class="container">
        <p>From complimentary shuttle service to event spaces available for leasing
            Platinum Park offers something that goes beyond vibrant working space to suit your modern needs.
            </p>

        <div class="row">
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-1.png') }}" alt="">
                <p>Banking services & ATM</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-2.png') }}" alt="">
                <p>Event Space</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-3.png') }}" alt="">
                <p>Gymnasium</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-4.png') }}" alt="">
                <p>Eating Hall</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-5.png') }}" alt="">
                <p>Convenience Store</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-6.png') }}" alt="">
                <p>Wellness &amp; Beauty</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-7.png') }}" alt="">
                <p>Prayer Room</p>
            </div>
            <div class="col-sm-3 col-6">
                <img src="{{ asset('assets/web/images/conveniences/content-8.png') }}" alt="">
                <p>Transportation 
                    Shuttle Service</p>
            </div>
        </div>
            
        
    </div>
 </section> 

@endsection

