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

document.addEventListener('DOMContentLoaded', function() {
    // Deteksi viewport width
    const viewportWidth = window.innerWidth;
    
    // Setting berdasarkan ukuran viewport
    let aosSettings = {
        startEvent: 'DOMContentLoaded',
        easing: 'ease',
        mirror: false,
        anchorPlacement: 'top-bottom',
    };
    
    // Konfigurasi berbasis breakpoint
    if (viewportWidth < 480) {
        // Untuk device sangat kecil (small phones)
        Object.assign(aosSettings, {
            offset: 20,
            delay: 0,
            duration: 300,
            once: true,
            disable: true // Matikan animasi pada device sangat kecil
        });
    } else if (viewportWidth < 768) {
        // Untuk device mobile (tablets & larger phones)
        Object.assign(aosSettings, {
            offset: 40,
            delay: 0,
            duration: 400,
            once: true
        });
    } else if (viewportWidth < 1024) {
        // Untuk tablets landscape dan laptop kecil
        Object.assign(aosSettings, {
            offset: 60,
            delay: 30,
            duration: 600,
            once: false
        });
    } else {
        // Untuk desktop
        Object.assign(aosSettings, {
            offset: 120,
            delay: 50,
            duration: 800,
            once: false
        });
    }
    
    // Inisialisasi AOS dengan settings yang sesuai
    AOS.init(aosSettings);
    
    // Re-inisialisasi AOS saat resize window
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            AOS.refresh();
        }, 250);
    });
});