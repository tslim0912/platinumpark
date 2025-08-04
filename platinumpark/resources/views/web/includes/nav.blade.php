<div id="navbar" class="navigation {{ (request()->is('enquiry')) ? 'new-sticky' : '' }} {{ (request()->is('whats-on')) ? 'new-sticky' : '' }} {{ (request()->is('lifestyle/*')) ? 'new-sticky' : '' }} {{ (request()->is('privacy-policy')) ? 'new-sticky' : '' }} {{ (request()->is('terms-and-conditions')) ? 'new-sticky' : '' }}" >
    <div class="container">
        <div class="row">
            <div class="col-md-1">
               <a href="{{ route('home') }}">
                    <img class="logo" src="{{  asset('assets/web/images/logo.png') }}" alt="">
                    <img class="logo-black" src="{{  asset('assets/web/images/logo-black.png') }}" alt="">
                </a>
            </div>
            <div class="col-md-11">
                <ul>
                   <li><a href="{{ route('business') }}">Business</a></li>
                   <li><a href="{{ route('lifestyle') }}">Lifestyle</a></li>
                   <li><a href="{{ route('conveniences') }}">Conveniences</a></li>
                   <li><a href="{{ route('whats-on') }}">What's On</a></li>
                   <li><a href="{{ route('contact') }}">Contact Us</a></li>
                   <li><a href="{{ route('about-us') }}">About Us</a></li>
                   <li><a target="_blank" href="https://ul.waze.com/ul?preview_venue_id=66650144.666632507.2256257&navigate=yes&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location">Getting Here</a></li>

                    <li class="search"> 
                        {{-- <a target="_blank" href="https://goo.gl/maps/k64znABUUHCRqDTe7"><i class="fas fa-map-marker-alt"></i></a> --}}

                        <a class="menu-responsive-btn collapsed" role="button" data-toggle="collapse" href="#search_collapse" aria-expanded="false" aria-controls="search_collapse"><i class="fa fa-search"></i></a>
                    </li>

                    <li class="inquiry"> 
                        <a class="btn-primary" href="{{ route('enquiry') }}">Make An Inquiry</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="menu-responsive-drop collapse" id="search_collapse" style="height: 0px;">
                    {!! Form::open(["method"=>"GET", "id" => "search-form", "name" => "search-form", 'url'=>route('lifestyle.search'), "class" => 'search-form on' ]) !!}
                    <div class="search_form">
                        <i id="search-submit-btn" class="fa fa-search searchButton"></i>
                        <input type="text" name="keyword" autocomplete="off" value="" class="searchTerm search-form_input">
                        <div class="smartsearch"></div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
            
       
</div> 