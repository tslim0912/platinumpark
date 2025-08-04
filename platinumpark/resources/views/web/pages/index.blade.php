@extends('web.layouts.master')


@section('content')

<section class="home">
    <div class="home-slider">
        <div class="relative">
            <img src="{{ asset('assets/web/images/homepage/home-banner-1.png') }}" alt="">
            <div class="absolute">
                <div class="container">
                    <h1><b>3</b> Towers <br />
                        <b>2,500</b> Office Tenants <br />
                        <b>1</b> fine place where <br />
                        success stories  begin</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-about section-content"> 
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-4 ">
                <img src="{{ asset('assets/web/images/homepage/home-content-1.png') }}" alt="">
                <p>24 HOURS <br>
                    SECURITY</p>
            </div>

            <div class="col-sm-4 col-4 ">
                <img src="{{ asset('assets/web/images/homepage/home-content-2.png') }}" alt="">
                <p>MSC STATUS</p>
            </div>

            <div class="col-sm-4 col-4 ">
                <img src="{{ asset('assets/web/images/homepage/home-content-3.png') }}" alt="">
                <p>COMPLIMENTARY<br>SHUTTLE SERVICE</p>
            </div>
        </div>
    </div>
</section>

<section class="home-image section-content"> 
    <div class="row">
        <div class="col-sm-6 col-12 ">
           <a href="{{ route('business') }}"><img src="{{ asset('assets/web/images/homepage/home-content-4.png') }}" alt=""></a> 
        </div>
        <div class="col-sm-6 col-12 ">
            <a href="{{ route('lifestyle') }}"><img src="{{ asset('assets/web/images/homepage/home-content-5.png') }}" alt=""></a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-12 ">
            <img src="{{ asset('assets/web/images/homepage/home-content-6.png') }}" alt="">
        </div>
        <div class="col-sm-3 col-12 ">
          <a href="{{ route('business') }}"><img src="{{ asset('assets/web/images/homepage/home-content-7.png') }}" alt=""></a>
        </div>
        <div class="col-sm-3 col-12 ">
            <img src="{{ asset('assets/web/images/homepage/home-content-8.png') }}" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-12 ">
            <img src="{{ asset('assets/web/images/homepage/home-content-9.png') }}" alt="">
        </div>
        <div class="col-sm-3 col-12 ">
          <a href="{{ route('whats-on') }}"><img src="{{ asset('assets/web/images/homepage/home-content-10.png') }}" alt=""></a>
        </div>
        <div class="col-sm-3 col-12 ">
            <a href="{{ route('conveniences') }}"><img src="{{ asset('assets/web/images/homepage/home-content-11.png') }}" alt=""></a>
        </div>
    </div>
</section>

<section class="home-map"> 
    <div class="row">
        <div class="col-sm-12 col-12 ">
          <img src="{{ asset('assets/web/images/homepage/home-content-13.png') }}" alt="">
        </div>
    </div>
</section>

@endsection

