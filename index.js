gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create(getAnimSettings("#download"));
ScrollTrigger.create(getAnimSettings("#socials"));
ScrollTrigger.create(getAnimSettings("#roadmap"));
ScrollTrigger.create(getAnimSettings("#login"));
ScrollTrigger.create(getAnimSettings("#work"));
ScrollTrigger.create(getAnimSettings("#credit"));

function getAnimSettings(selector) {
    return {
        trigger: selector,
        start: "top 75%",
        end: "end top",
        scrub: true,
        /* markers: true, */
        onEnter: () => gsap.to(selector, {
            opacity: 1
        }),
        onLeave: () => gsap.to(selector, {
            opacity: 0
        }),
        onEnterBack: () => gsap.to(selector, {
            opacity: 1
        }),
        onLeaveBack: () => gsap.to(selector, {
            opacity: 0
        })
    };
}