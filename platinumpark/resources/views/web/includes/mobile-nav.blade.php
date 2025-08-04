<div class="moto-widget-mobile" id="navbar-mobile">
    {{-- <div class="mobile-logo"><a href="{{ route('home') }}"><img class="logo" src="{{  asset('assets/web/images/logo.png') }}" alt=""></a></div> --}}
    
    <div class="icon">
        <a href="{{ route('home') }}">
            <img class="logo" src="{{  asset('assets/web/images/logo.png') }}" alt="">
            <img class="logo-black" src="{{  asset('assets/web/images/logo-black.png') }}" alt="">
        </a>
    </div>

    <div class="burger-container">
        <div id="burger">
            <i class="fa fa-bars burger-mobile"></i>
        </div>
    </div>

    <ul  class="menu" id="accordion">
        {!! Form::open(["method"=>"GET", "id" => "mobile-search-form", "name" => "search-form", 'url'=>route('lifestyle.search'), "class" => 'search-form on' ]) !!}
        <div class="search">
            <input type="text" name="keyword" autocomplete="off" value="" class="searchTerm search-form_input">
            <a id="mobile-search-submit-btn" class="searchButton"><i class="fa fa-search"></i></a>
        </div>
    {!! Form::close() !!}
        
        <li><a href="{{ route('business') }}">Business</a></li>
        <li><a href="{{ route('lifestyle') }}">Lifestyle</a></li>
        <li><a href="{{ route('conveniences') }}">Conveniences</a></li>
        <li><a href="{{ route('whats-on') }}">What's On</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li>
        <li><a href="{{ route('about-us') }}">About Us</a></li>
        <li><a target="_blank" href="https://ul.waze.com/ul?preview_venue_id=66650144.666632507.2256257&navigate=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location">Getting Here</a></li>
        
        {{-- <li> 
            <a target="_blank" href="https://goo.gl/maps/k64znABUUHCRqDTe7"><i class="fas fa-map-marker-alt"></i></a>
        </li> --}}

        {{-- <li class="search"> 
            <a class="menu-responsive-btn collapsed" role="button" data-toggle="collapse" href="#search_collapse" aria-expanded="false" aria-controls="search_collapse"><i class="fa fa-search"></i></a>
        </li> --}}
        <li class="inquiry"> 
            <a class="btn-primary" href="{{ route('enquiry') }}">Make An Inquiry</a>
        </li>
    </ul>
  
</div>