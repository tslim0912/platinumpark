@extends('web.layouts.master')


@section('content')

 <section class="section-content content whats-content">
    <div class="container">
        <h1>What's On</h1>
        <p>Explore the latest happenings in town at Naza Tower, with a selection of F&B deals, dining and tenant offers that accommodate to your lifestyle needs and preference.
        </p>

        <div class="row">
            <div class="col-12 col-sm-3">
                <img src="{{ asset('assets/web/images/whatson/may-update-sushiryu-1.jpg') }}" alt="">
                <p>Sushi Ryu | Come &amp; Celebrate Father's Day</p>
                <a href="{{ route('lifestyle-detail', ['slug' => 'sushi-ryu']) }}">More Details</a>
            </div>
            <div class="col-12 col-sm-3">
                <img src="{{ asset('assets/web/images/whatson/may-update-sushisora-1.jpg') }}" alt="">
                <p>Sushi Sora | We're open on Father's Day</p>
                <a href="{{ route('lifestyle-detail', ['slug' => 'sushi-sora']) }}">More Details</a>
            </div>
            <div class="col-12 col-sm-3">
                <img src="{{ asset('assets/web/images/whatson/may-update-wagyu-kappo-yoshida-1.jpg') }}" alt="">
                <p>Wagyu Kappo Yoshida | We are open on Father's Day</p>
                <a href="{{ route('lifestyle-detail', ['slug' => 'wagyu-kappo-yoshida']) }}">More Details</a>
            </div>
        </div>
    </div>
 </section>

@endsection

