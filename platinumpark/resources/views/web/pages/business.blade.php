@extends('web.layouts.master')


@section('content')
<section class="banner-section">
    <div class="relative">
        <img src="{{ asset('assets/web/images/business/banner.png') }}" alt="">
        <div class="absolute">
            <div class="container">
                <h1>Business</h1>
                <p><a href="{{ route('home') }}">Home</a> <span>></span> Business</p>
            </div>
        </div>
    </div>
 </section>

 <section class="section-content content">
    <div class="container">
        <p>As a place where business meets success, Naza Tower features corporate space setting and stunning offices that are ready for leasing, all of which create a vibrant business community </p>
        <p>&nbsp;</p>
        <h3>CO-LABS CO WORKING</h3>

        <p>A thoughtfully-designed workspace uniquely designed for rising entrepreneurs, freelancers, start-ups, and corporates to designate their working zone and flourish within a collaborative ecosystem.</p>

        <p><i>click <a target="_blank" href="http://co-labs.asia/">here</a> to find more</i></p>
    </div>
 </section>

@endsection

