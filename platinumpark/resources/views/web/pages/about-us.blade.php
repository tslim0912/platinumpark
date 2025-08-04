@extends('web.layouts.master')


@section('content')
<section class="banner-section">
    <div class="relative">
        <img src="{{ asset('assets/web/images/about/banner.png') }}" alt="">
        <div class="absolute">
            <div class="container">
                <h1>About Us</h1>
                <p><a href="{{ route('home') }}">Home</a> <span>></span> Platinum Park</p>
            </div>
        </div>
    </div>
 </section>

 <section class="section-content content">
    <div class="container">
        <h1>Platinum Park</h1>

        <p>Launched in 2009, Platinum Park is a story of success on its own. Envisioned as a towering corporate metropolis by day and an unrivalled urban retreat by night, the integrated development features three Grade A office towers. One of them is a 50-storey Naza Tower that comprises an eclectic mix of distinguished tenants which include embassies, MNCs and a vibrant co-working space. It’s a place where luxury meets pleasure and business meets success.</p>

    </div>
 </section>

@endsection

