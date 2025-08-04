<div class="footer relative">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-12">
                <img src="{{ asset('assets/web/images/footer-logo.png') }}" alt="">
            </div>
            <div class="col-sm-6 col-12">
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <ul>
                            <li class="{{ route('business') }}" > <a href="">Business</a></li>
                            <li class="{{ route('lifestyle') }}" > <a href="">Lifestyle</a></li>
                            <li> <a href="{{ route('conveniences') }}">Conveniences</a></li>
                            <li> <a href="{{ route('whats-on') }}">What's On</a></li>
                            <li><a target="_blank" href="https://ul.waze.com/ul?preview_venue_id=66650144.666632507.2256257&navigate=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location">Getting Here</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-12">
                        <ul>
                            <li><a href="{{ route('about-us') }}">About us</a></li>
                            <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                          

                        </ul>
                    </div>
                    <div class="col-sm-4 col-12">
                        <ul>
                            <li><a href="#">Follow Us</a></li>
                            <li class="social-media">
                                <a target="_blank" href="https://www.facebook.com/PlatinumParkKL"><i class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="https://www.instagram.com/platinumpark_kl/"><i class="fab fa-instagram"></i></a>
                                {{-- <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a> --}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            COPYRIGHT &copy; {{ date("Y") }} NAZA GROUP.  ALL RIGHTS RESERVED.
        </div>
    </div>
</div>
