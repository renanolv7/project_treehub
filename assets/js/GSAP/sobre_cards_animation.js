
// Animação para os cards do sobre
document.addEventListener('DOMContentLoaded', function( ) {
    gsap.from('.slide-in-left', {
        x: '-100%', 
        duration: 1, 
        ease: "power2.out",
        opacity: 0.5,
        delay: 0.1 
    });

    gsap.from('.slide-in-right', {
        x: '100%',
        duration: 1,
        ease: "power2.out",
        opacity: 0.5,
        delay: 0.1 
    });

    gsap.from('.slide-in-item', {
        x: '100%', 
        duration: 0.2,
        ease: "powe2.out",
        opacity: 0.5,
        stagger: 0.2, 
        delay: 0.2
    });
});