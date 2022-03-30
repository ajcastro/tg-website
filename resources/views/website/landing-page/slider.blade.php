<section class="banner" id="banner" style="margin: 0px 8vw;">
    <div class="swiper banner-slider">
        <div class="swiper-wrapper slide-wrapper">

        @foreach (\App\Models\Promotion::getPromotionsOfCurrentWebsite(auth()->user()) as $promotion)
            <div class="swiper-slide slide">
                <div class="image">
                    <img src="{{ $promotion->getImageUrlAttribute() }}" alt="{{ $promotion->title }}" />
                </div>
            </div>
        @endforeach

    </div>

    <div class="swiper-pagination"></div>

</section>

@push('page-script')
<script src="https://unpkg.com/swiper@7.4.1/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".banner-slider", {
        spaceBetween: 10,
        grabCursor: true,
        loop:true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
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
@endpush
