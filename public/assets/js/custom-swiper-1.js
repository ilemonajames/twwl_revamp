(() => {
    const root = document.querySelector('.site-hero .swiper');
    if (!root || typeof Swiper === 'undefined') return;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const slider = new Swiper(root, {
        autoplay: reducedMotion.matches ? false : {delay:3000,disableOnInteraction:false,pauseOnMouseEnter:true},
        effect:'slide', direction:'horizontal', slidesPerView:1, loop:true,
        speed:reducedMotion.matches ? 0 : 1200, mousewheel:false,
        watchSlidesProgress:true, parallax:!reducedMotion.matches, spaceBetween:-1,
        pagination:{el:root.querySelector('.swiper-pagination'),type:'fraction'},
        navigation:{nextEl:root.querySelector('.swiper-button-next'),prevEl:root.querySelector('.swiper-button-prev')},
    });
    const toggle = root.querySelector('.site-slider-toggle');
    let paused = reducedMotion.matches;
    function label() {
        if (!toggle) return;
        toggle.textContent = paused ? 'Play slideshow' : 'Pause slideshow';
        toggle.setAttribute('aria-label', toggle.textContent);
    }
    label();
    toggle?.addEventListener('click', () => {
        paused = !paused;
        if (paused) slider.autoplay?.stop();
        else if (slider.params.autoplay) slider.autoplay?.start();
        else {
            slider.params.autoplay = {delay:3000,disableOnInteraction:false,pauseOnMouseEnter:true};
            slider.autoplay?.start();
        }
        label();
    });
    reducedMotion.addEventListener('change', event => {
        if (event.matches) { paused = true; slider.autoplay?.stop(); label(); }
    });
})();
