@extends('web.layouts.master')


@section('content')
<section class="banner-section">
    <div class="relative">
        <img src="{{ asset('assets/web/images/contact/banner.png') }}" alt="">
        <div class="absolute">
            <div class="container">
                <h1>Contact Us</h1>
                <p><a href="{{ route('home') }}">Home</a> <span>></span> Contact Us</p>
            </div>
        </div>
    </div>
 </section>

 <section class="section-content content contact-content">
    <div class="container">
        <p>Persiaran KLCC, 50088 Kuala Lumpur, <br>
            Wilayah Persekutuan, Malaysia.</p>
            
        <p><a href="mailto:helpdesk.nazatower@nazaasset.com.my">helpdesk.nazatower@nazaasset.com.my</a></p>   

        <p><a href="tel:+60122529298">+6012-252-9298</a></p>   

        <p>General office hours are from <br>
            Monday-Friday <br />9:00am-5:30pm <br><br/>
            Saturday-Sunday <br />Close</p><br/>

        <ul class="social-media-list d-flex gap-2">
            <li class="social-media">
                <a href="https://www.instagram.com/platinumpark_kl"><i class="fab fa-instagram" aria-hidden="true"></i></a>
            </li>
        </ul>

        <p><a class="enquiry-btn" href="{{  route('enquiry') }}">Make An Enquiry</a></p>
    </div>
 </section>

@endsection

