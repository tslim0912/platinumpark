<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" data-ng-app="website">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


<head>



    <meta charset="utf-8">

    {{-- <link rel="shortcut icon" type="image/x-icon" href="https://www.laglobaltravel.com/uploads/Icon-LaGlobal-sqclear.png">
    <link rel="apple-touch-icon" href="https://www.laglobaltravel.com/uploads/Icon-LaGlobal-sqclear.png"/>
    <link rel="icon" href="https://www.laglobaltravel.com/uploads/cropped-logo-mobile-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://www.laglobaltravel.com/uploads/cropped-logo-mobile-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="https://www.laglobaltravel.com/uploads/cropped-logo-mobile-180x180.png" /> --}}

    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/vnd.microsoft.icon" />

    <title>Platinum Park  - Platinum Park Kuala Lumpur</title>
    <meta name="title" content="Platinum Park " />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="Platinum Park " />
	<meta name="twitter:description" content="Located in the heart of Kuala Lumpur is an integrated development incorporating office tower, luxury residential, hotel &amp; bustling retail hub at persiaran KLCC" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Platinum Park Kuala Lumpur" />
	<meta property="og:title" content="Platinum Park " />
	<meta property="og:description" content="Located in the heart of Kuala Lumpur is an integrated development incorporating office tower, luxury residential, hotel &amp; bustling retail hub at persiaran KLCC" />
	<meta property="og:image" content="http://www.platinumpark.com.my/images/contact-us/contact-banner-4.jpg" />
	<meta property="og:url" content="http://www.platinumpark.com.my/" />
	<meta name="description" content="Located in the heart of Kuala Lumpur is an integrated development incorporating office tower, luxury residential, hotel &amp; bustling retail hub at persiaran KLCC" />



 

    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link  rel="shortcut icon" type="image/*" href="{{ asset('assets/web/images/logo/H_Logo Fav Nutricious.png') }}" /> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('assets/web/css/assets.min.css'.'?v='.time()) }}" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:regular,100,100italic,200,200italic,300,300italic,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic|Mr+Dafoe:regular|Open+Sans:regular,300,300italic,italic,600,600italic,700,700italic,800,800italic&amp;subset=latin,cyrillic,latin-ext,vietnamese,cyrillic-ext,greek-ext,greek" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/web/css/styles.css'.'?v='.time()) }}" /> --}}

    <link rel="stylesheet" href="{{ URL::asset('assets/web/css/main.css'.'?v='.time()) }}" />

    <link rel="stylesheet" href="{{ URL::asset('assets/web/css/custom.css'.'?v='.time()) }}" />

    <link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/all.css') }}" />

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/sweetalert2/sweetalert2.min.css') }}" /> --}}

    @yield('style')

</head>



<body>

    <div class="page window">

        


        <header id="section-header" class="header">

            {{-- @include('web.includes.header') --}}

            @include('web.includes.nav')

            @include('web.includes.mobile-nav')


        </header>


        @yield('content')

    </div>



    @include('web.includes.footer')


    <input type="hidden" class="logged-in" value="{{ Auth::check() }}">

    <script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}

    
    </body>

   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />

    <!-- Date Time Picker -->
    <link href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


    <!-- Auto Height -->
    <script src="{{ asset('js/jquery.matchHeight.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

    <script src="{{ asset('assets/js/jquery.cookie.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/web/js/custom.js'.'?v='.time()) }}"></script> --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/jQuery-Mask-Plugin/jquery.mask.min.js') }}"></script>
    <!-- Dropdown Country Code with Flag -->
    <link href="{{ asset('assets/build/css/intlTelInput.css') }}" rel="stylesheet" type="text/css">
    <!-- Use as a jQuery plugin -->
    <script src="{{ asset('assets/build/js/intlTelInput-jquery.min.js')}}"></script>
    <script src="{{ asset('assets/build/js/utils.js')}}"></script>
    <!-- Alpinejjs -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

    {{-- Scroll Magic --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.2/plugins/animation.gsap.js"></script>

    {{-- <script type="text/javascript" src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js" integrity="sha512-m5kAjE5cCBN5pwlVFi4ABsZgnLuKPEx0fOnzaH5v64Zi3wKnhesNUYq4yKmHQyTa3gmkR6YeSKW1S+siMvgWtQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.js" integrity="sha512-LjDU5V5K+EixYXzTBmWnQPPLZXTUNJOfwB0UPnFqbPeoUl2/N/AKPJAYVuNNmMv9RZeGZXRwu4PDI37GCRuOTQ==" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/xzoom/dist/xzoom.css" media="all" /> --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    {{-- Light Box --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.css"> --}}

    @if (session()->has('success'))
    <script type="text/javascript">
        $(function () {
            Swal.fire({
                icon: 'success',
                title: "Success",
                text: "{!! session()->get('success') !!}",
            })
        });
    </script>
    @endif


    @if (session()->has('status'))
    <script type="text/javascript">
        $(function () {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{!! session()->get('status') !!}",
            })
        });
    </script>
    @endif


    @if (session()->has('points_error'))
    <script type="text/javascript">
        $(function () {
            Swal.fire({
                imageUrl: '{{ URL::asset("assets/web/images/icon/insufficient points_pop up.png") }}',
                imageHeight: 150,
                title: 'Uh ohh!!',
                text: "{!! session()->get('points_error') !!}",
            })
        });
    </script>
    @endif

    @if (session()->has('register_status'))
    <script type="text/javascript">
        $(function () {
            Swal.fire({
                imageUrl: '{{ URL::asset("assets/web/images/icon/email verify_pop up.png") }}',
                imageHeight: 150,
                title: 'Success!',
                text: "{!! session()->get('register_status') !!}",
            })
        });
    </script>
    @endif

    @if (session()->has('error'))
    <script type="text/javascript">
        $(function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{!! session()->get('error') !!}",
            })
        });
    </script>
    @endif

    @if (session()->has('warning'))
    <script type="text/javascript">
        $(function () {
            Swal.fire({
                icon: 'warning',
                // title: 'Oops...',
                text: "{!! session()->get('warning') !!}",
            })
        });
    </script>
    @endif

    @if (session()->has('resend-verif-email'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{!! session()->get('resend-verif-email') !!}",
        }).then(function (e) {

            if (e.value === true) {
               $("#resend-email-link").show();
            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    </script>
    @endif

    @if (session()->has('stripe-error'))
    <script>
        $(function () {
            swal.fire({
                position: 'center',
                type: 'error',
                title: "Stripe Error",
                html: "<p>{!! session()->get('stripe-error') !!}</p>",
                width: '60vh',
                icon: 'warning',
            });
        });
    </script>
    @endif

    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js'></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{-- Light Box --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.js" integrity="sha512-UHlZzRsMRK/ENyZqAJSmp/EwG8K/1X/SzErVgPc0c9pFyhUwUQmoKeEvv9X0uNw8x46FxgIJqlD2opSoH5fjug==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.youtube.com/player_api"></script>
    {{-- <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>

        $(window).scroll(function() {
            var header = $(".navigation");
            var mobile_header = $("#navbar-mobile");
            var scroll = $(window).scrollTop();
            // console.log(scroll);
            if (scroll >= 50) {
                header.addClass("sticky");
                mobile_header.addClass("sticky");
            } else {
                header.removeClass('sticky');
                mobile_header.removeClass('sticky');
            }
        });
        
       
        AOS.init();

        $(document).ready(function() {

            $( ".burger-container" ).click(function() {
                $('#navbar-mobile').toggleClass('open');
                $( this ).next().slideToggle( "fast", function() {
                    // Animation complete.
                });
            });

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'disableScrolling': true,
            })

            $('.home-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                nav: false,
                fade: !0,
                cssEase: 'linear',
            });


            $('.gallery').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: '60px',
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                        }
                    },
			    ]
            });

            $( ".lifestyle-gallery" ).each(function() {
                $(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                })
            });

           
        })
        

        document.getElementById("search-submit-btn").onclick = function() {
            document.getElementById("search-form").submit();
        }

        document.getElementById("mobile-search-submit-btn").onclick = function() {
            document.getElementById("mobile-search-form").submit();
        }

        $(document).on('change', '.sort-by-select', function (event) {
            event.preventDefault();
            $('#sort_form').submit();
        });

    </script>
    @yield('javascript')
</body>

</html>
