<swiper-container class="mySwiper w-full h-[900px]" pagination="true" pagination-clickable="true" navigation="true"
    space-between="30" centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false">
    <swiper-slide>
        <img class="w-full h-full aspect-video object-fit" src="banner/1.jpg" alt="">
    </swiper-slide>
    <swiper-slide>
        <img class="w-full h-full aspect-video object-fit" src="banner/2.jpg" alt="">
    </swiper-slide>
    <swiper-slide>
        <img class="w-full h-full aspect-video object-fit" src="banner/3.jpg" alt="">
    </swiper-slide>
    <swiper-slide>
        <img class="w-full h-full aspect-video object-fit" src="banner/4.jpg" alt="">
    </swiper-slide>
    <swiper-slide>
        <img class="w-full h-full aspect-video object-fit" src="banner/5.jpg" alt="">
    </swiper-slide>

    <div class="autoplay-progress" slot="container-end">
        <svg viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <span></span>
    </div>
</swiper-container>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");

    const swiperEl = document.querySelector("swiper-container");
    swiperEl.addEventListener("autoplaytimeleft", (e) => {
        const [swiper, time, progress] = e.detail;
        progressCircle.style.setProperty("--progress", 1 - progress);
        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
    });
</script>
