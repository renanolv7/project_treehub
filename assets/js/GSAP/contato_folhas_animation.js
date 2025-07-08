document.addEventListener('DOMContentLoaded', function( ) {
    gsap.from('.slide-in-left', {
        x: '-100%', 
        opacity: 1,
        duration: 3, 
        ease: 'power2.out', 
        delay: 0.1 
    });

    gsap.from('.slide-in-top', {
        y: '-100%',
        opacity: 1,
        duration: 4,
        ease: 'power2.out',
        delay: 0.2 
    });


});