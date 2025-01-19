<!-- npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Multi Design Pattern Ecommerce</title>
    <link rel="icon" type="image/x-icon" href="{{url('/favicon.ico')}}">

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="{{asset('frontend/js/tailwind.js')}}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,400;1,600&family=Roboto+Serif:wght@200;400;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,500;1,700&display=swap"
        rel="stylesheet" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" />
    <!-- slick carosel -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/site.css')}}" />

    <style>
    /* for left arrow */
    span.prev.slick-arrow {
        left: 13px;
        top: 185px;
        position: absolute;
        z-index: 7;
    }

    span.prev.slick-arrow i {
        background-color: white;
        height: 26px;
        width: 26px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        transition: all 0.4s ease-in-out
    }
    span.prev:hover.slick-arrow i{
        background-color: #ff6a28;
        color: white;
        transition: all 0.4s ease-in-out
    }

    /* for right arrow */
    span.next.slick-arrow {
        right: 13px;
        top: 185px;
        position: absolute;
        z-index: 7;
    }

    span.next.slick-arrow i {
        background-color: white;
        height: 26px;
        width: 26px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        transform: rotate(180deg);
        transition: all 0.4s ease-in-out
    }
    span.next:hover.slick-arrow i{
        background-color: #ff6a28;
        color: white;
        transition: all 0.4s ease-in-out
    }
    .dropdownn:hover .dropdownnm {
        display: block;
    }
    .dropdown:hover .dropdown1 {
        display: block;
    }

    .dropdown2:hover .dropdown3 {
        display: block;
    }


    body {
        font-family: "Nunito Sans", sans-serif;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .slick-slide {
        margin: 0 5px;
    }

    .slick-list {
        margin: 0 -5px;
    }
    </style>

    <link rel="stylesheet" href="{{asset('frontend/css/toastr.min.css')}}">


</head>

<body>

    @include('frontend.fixed.header')


    @if (request()->route()->getName()!='home')

    @include('frontend.fixed.menubar')

    @endif
    <!--banner start -->

    @yield('content')

    <!-- footer section -->
    @include('frontend.fixed.footer')

    <!-- Alpine.js for tab -->
    <script src="{{asset('frontend/js/alpine.min.js')}}" defer></script>
    <!-- slick carosel -->
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>


    <script src="{{asset('frontend/js/toastr.min.js')}}"></script>
    {!! Toastr::message() !!}
    <script type="text/javascript" src="{{asset('frontend/js/slick.min.js')}}"></script>

    <!-- script for modal -->
    <script>
    function toggleModal() {
        document.getElementById('modal').classList.toggle('hidden')
    }
    </script>
    <!-- script for product -->
    <script>
    $(document).ready(function() {
        $(".slider").slick({
            slidesToShow: 3,
            autoplay: false,
            autoplaySpeed: 5000,
            arrows: true,
            prevArrow: '<span class="prev"><i class="fa-sharp fa-solid fa-arrow-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa-sharp fa-solid fa-arrow-left"></i></span>',

            responsive: [{
                    breakpoint: 768,
                    settings: {
                        // centerMode: true,
                        centerPadding: "10px",
                        slidesToShow: 3,
                        arrows: true,

                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        // centerMode: true,
                        centerPadding: "10px",
                        slidesToShow: 2,
                        arrows: true,

                    },
                },
            ],
        });
    });
    </script>
    <!-- script for banner -->
    <script>
    $(document).ready(function() {
        $(".banner-slider").slick({
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true,
            prevArrow: '<span class="prev"><i class="fa-sharp fa-solid fa-arrow-left"></i></span>',
            nextArrow: '<span class="next"><i class="fa-sharp fa-solid fa-arrow-left"></i></span>',
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        // centerMode: true,
                        // centerPadding: "40px",
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        // centerMode: true,
                        // centerPadding: "40px",
                        slidesToShow: 1,
                    },
                },
            ],
        });
    });
    </script>
    @stack('scripts')
</body>

</html>