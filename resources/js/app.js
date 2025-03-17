import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'
import collapse from '@alpinejs/collapse'
import "aos/dist/aos.css";
import AOS from "aos";

AOS.init();

window.Alpine = Alpine;
Alpine.plugin(intersect)
Alpine.plugin(collapse)
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
});
Alpine.start();
