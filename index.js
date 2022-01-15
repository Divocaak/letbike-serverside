gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create(getAnimSettings("#download"));
ScrollTrigger.create(getAnimSettings("#roadmap"));
ScrollTrigger.create(getAnimSettings("#login"));
ScrollTrigger.create(getAnimSettings("#work"));
ScrollTrigger.create(getAnimSettings("#credit"));
ScrollTrigger.create(getAnimSettings(".work-0"));
ScrollTrigger.create(getAnimSettings(".work-1"));
ScrollTrigger.create(getAnimSettings(".work-2"));
ScrollTrigger.create(getAnimSettings(".work-3"));
ScrollTrigger.create(getAnimSettings(".work-4"));

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