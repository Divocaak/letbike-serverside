gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create(getAnimSettings("#download"));
ScrollTrigger.create(getAnimSettings("#roadmap"));
ScrollTrigger.create(getAnimSettings("#login"));
ScrollTrigger.create(getAnimSettings("#work"));
ScrollTrigger.create(getAnimSettings("#credit"));
ScrollTrigger.create(getAnimSettings("#divocak"));
ScrollTrigger.create(getAnimSettings("#kreslin"));

function getAnimSettings(selector) {
    return {
        trigger: selector,
        start: "top 70%",
        end: "center 20%",
        scrub: true,
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