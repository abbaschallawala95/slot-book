// Hero Section Animations
gsap.from(".hero-title", {
    duration: 1,
    y: -50,
    opacity: 0,
    ease: "power3.out",
  });
  
  gsap.from(".hero-subtitle", {
    duration: 1,
    y: 50,
    opacity: 0,
    delay: 0.5,
    ease: "power3.out",
  });
  
  gsap.from(".carousel-item", {
    duration: 1,
    y: 50,
    opacity: 0,
    stagger: 0.3,
    delay: 1,
    ease: "power3.out",
  });
  
  // Popular Watches Section Animations
  gsap.from(".watch-card", {
    scrollTrigger: {
      trigger: ".popular-watches",
      start: "top 80%",
    },
    duration: 1,
    y: 50,
    opacity: 0,
    stagger: 0.3,
    ease: "power3.out",
  });
  
  // About Section Animations
  gsap.from(".about-text", {
    scrollTrigger: {
      trigger: ".about",
      start: "top 80%",
    },
    duration: 1,
    y: 50,
    opacity: 0,
    ease: "power3.out",
  });