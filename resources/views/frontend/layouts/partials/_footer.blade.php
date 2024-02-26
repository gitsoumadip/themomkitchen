<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    var TOAST_POSITION = 'top-right';
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
{{-- <script src="http://themkds.com/script.js"></script> --}}
{{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
<script src="{{ asset('admin_assets/js/common.js') }}"></script>

{{-- <script src="assets/js/jquery.min.js"></script> --}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('admin_assets/js/main.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- font aawesome kit -->
<script src="https://kit.fontawesome.com/c7890550ed.js" crossorigin="anonymous"></script>

<!-- swiper js -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- animation js -->
<script src="{{ asset('assets/js/aos.js') }}"></script>
<!-- stellarnav -->
<script src="{{ asset('assets/js/stellarnav.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<!-- hero section -->
<script>
    const not_active_slide_scale_value = 0.85;
    const not_active_slide_opacity_value = 0.4;

    var swiper_scale_active = new Swiper("[swiper_scale_active]", {
        slidesPerView: 1.5,
        parallax: true,
        loop: true,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
                speed: 900 /* Duration of transition between slides (in ms) */ ,
                slidesPerView: 1.2,
            },
            // when window width is >= 640px
            640: {
                speed: 1400,
            },
        },
        keyboard: {
            enabled: true,
        },
        centeredSlides: true,
        loop: true,
        slideToClickedSlide: true,
        spaceBetween: 0,
        grabCursor: true,

        autoplay: {
            delay: 1000,
        },
        // Navigation arrows (not in use)
        navigation: {
            nextEl: "[btn_group] [next2]",
            prevEl: "[btn_group] [prev2]",
        },
        effect: "creative",
        creativeEffect: {
            limitProgress: 2, // slides after 2nd before/after active will have same state
            prev: {
                opacity: not_active_slide_opacity_value,
                scale: not_active_slide_scale_value,
                // will set `translateX(-90%)` on previous slides
                translate: ["-90%", 0, 0],
            },
            next: {
                opacity: not_active_slide_opacity_value,
                scale: not_active_slide_scale_value,
                // will set `translateX(90%)` on next slides
                translate: ["90%", 0, 0],
            },
        },
    });

    /* CUSTOM ARROWS CODE (WE want 5 click on next will change 5 slides - the speed is 0) */
    const prev = document.querySelector("[btn_group] [prev]");
    prev.addEventListener("click", prev_slide);

    function prev_slide() {
        swiper_scale_active.slidePrev(0);
    }

    const next = document.querySelector("[btn_group] [next]");
    next.addEventListener("click", next_slide);

    function next_slide() {
        swiper_scale_active.slideNext(0);
    }

    /* API event example (Not in use in this code) */
    swiper_scale_active.on("slideChange", function() {
        console.log("slide changed");
    });

    swiper_scale_active.on("keyPress", function(swiper, keyCode) {
        console.log(swiper);
        console.log("keyCode", keyCode);
    });
</script>

<script>
    // typing effect
    const words = ["Family", "Friends", "Officemates"];
    let i = 0;
    let timer;

    function typingEffect() {
        let word = words[i].split("");
        var loopTyping = function() {
            if (word.length > 0) {
                document.getElementById('word').innerHTML += word.shift();
            } else {
                deletingEffect();
                return false;
            };
            timer = setTimeout(loopTyping, 200);
        };
        loopTyping();
    };

    function deletingEffect() {
        let word = words[i].split("");
        var loopDeleting = function() {
            if (word.length > 0) {
                word.pop();
                document.getElementById('word').innerHTML = word.join("");
            } else {
                if (words.length > (i + 1)) {
                    i++;
                } else {
                    i = 0;
                };
                typingEffect();
                return false;
            };
            timer = setTimeout(loopDeleting, 100);
        };
        loopDeleting();
    };

    typingEffect();
</script>

@stack('scripts')
{{-- C:\xampp\htdocs\momKichan\public\assets\js\script.js --}}
