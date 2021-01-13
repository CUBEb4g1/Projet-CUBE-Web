<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@stack('meta')
	<title>@hasSection('title')@yield('title') - @endif{{ config('app.name') }}</title>
	{{-- Favicon --}}
	<link rel="icon" type="image/png" href="{{ asset_cache('media/favicons/favicon.png') }}"/>
	{{--Fonts--}}
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	{{--Styles--}}
	<link href="{{ mix('css/front/vendor.css') }}" rel="stylesheet">
	<link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
	@stack('styles')
    {{--Scripts--}}
    <script></script>
</head>
<body id="top">
	@include('_partials.maintenance_ribbon')
	@include('_partials.switched-auth-warning')
    @include('front._layouts.mainmenu')
    {{-- Content --}}
	@yield('content')
    {{-- Back to Top Button --}}
    @include('front._partials._back_to_top')
    {{-- Footer --}}
    @include('front._layouts.footer')
    {{--Scripts--}}
	<script>
		var APP        = {};
		APP.csrf_token = '{{ csrf_token() }}';
		APP.notify     = {
			info: '{{ Session::get('infoNotif') }}',
			success: '{{ Session::get('successNotif') }}',
			warning: '{{ Session::get('warningNotif') }}',
			danger: '{{ Session::get('dangerNotif') }}',
		};
	</script>
	<script src="{{ mix('js/front/app.js') }}"></script>
    {{-- Sticky menu script cheat --}}
    <script>
        stickyElem =
            document.querySelector(".sticky-div");
        /* Gets the amount of height of the element from the viewport and adds the pageYOffset to get the height relative to the page */
        currStickyPos =
            stickyElem.getBoundingClientRect().top + window.pageYOffset;
        window.onscroll = function() {
            /* Check if the current Y offset is greater than the position of the element */
            if (window.pageYOffset > currStickyPos) {
                stickyElem.style.position = "fixed";
                stickyElem.style.top = "0px";
                stickyElem.style.left = "0px";
                stickyElem.style.right = "0px";
            } else {
                stickyElem.style.position = "relative";
                stickyElem.style.top = "initial";
            }
        }
    </script>
    {{-- Dark Mode Switch -- Not yet implemented but will be --}}
    <script>
        (function($) { "use strict";
            $(".switch").on('click', function () {
                if ($("body").hasClass("light")) {
                    $("body").removeClass("light");
                    $(".switch").removeClass("switched");
                }
                else {
                    $("body").addClass("light");
                    $(".switch").addClass("switched");
                }
            });
            {{-- Back to Top button --}}
            $(document).ready(function(){"use strict";
                var progressPath = document.querySelector('.progress-wrap path');
                var pathLength = progressPath.getTotalLength();
                progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
                progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
                progressPath.style.strokeDashoffset = pathLength;
                progressPath.getBoundingClientRect();
                progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
                var updateProgress = function () {
                    var scroll = $(window).scrollTop();
                    var height = $(document).height() - $(window).height();
                    var progress = pathLength - (scroll * pathLength / height);
                    progressPath.style.strokeDashoffset = progress;
                }
                updateProgress();
                $(window).scroll(updateProgress);
                var offset = 50;
                var duration = 550;
                jQuery(window).on('scroll', function() {
                    if (jQuery(this).scrollTop() > offset) {
                        jQuery('.progress-wrap').addClass('active-progress');
                    } else {
                        jQuery('.progress-wrap').removeClass('active-progress');
                    }
                });
                jQuery('.progress-wrap').on('click', function(event) {
                    event.preventDefault();
                    jQuery('html, body').animate({scrollTop: 0}, duration);
                    return false;
                })
            });
        })(jQuery);
    </script>
    @stack('scripts')
</body>
</html>
