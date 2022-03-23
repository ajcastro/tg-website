<section class="banner" id="banner" style="margin: 0px 10vw; margin-top: 30px;">
    <div class="swiper banner-slider">
        <div class="swiper-wrapper slide-wrapper">
            <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/1.jpg" alt="" />
            </div>
        </div>

        <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/2.jpg" alt="" />
            </div>
        </div>

        <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/3.jpg" alt="" />
            </div>
        </div>

        <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/4.jpg" alt="" />
            </div>
        </div>

        <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/5.jpg" alt="" />
            </div>
        </div>

        <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/6.jpg" alt="" />
            </div>
        </div>

        <div class="swiper-slide slide">
            <div class="image">
                <img src="tstimg/7.jpg" alt="" />
            </div>
        </div>
    </div>

    <div class="swiper-pagination"></div>

</section>

@section('page-script')
<script src="https://unpkg.com/swiper@7.4.1/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".banner-slider", {
        spaceBetween: 10,
        grabCursor: true,
        loop:true,
        // autoplay: {
        //     delay: 5000,
        //     disableOnInteraction: false,
        // },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints:{
            500:{
                slidesPerView: 1,
            },
            768:{
                slidesPerView: 3,
            },
            991:{
                slidesPerView: 5,
            },
        },
    });
</script>
@endsection
