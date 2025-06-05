// Faciona Professional Animations JavaScript

document.addEventListener('DOMContentLoaded', function() {
    console.log('Faciona animations loading...');

    // Safe Scroll Animation Observer
    try {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -30px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    try {
                        entry.target.classList.add('animate');
                        
                        // Animate children with stagger effect
                        const children = entry.target.querySelectorAll('.stagger-animate');
                        children.forEach((child, index) => {
                            setTimeout(() => {
                                child.classList.add('animate');
                            }, index * 100);
                        });
                    } catch (error) {
                        console.log('Animation error:', error);
                    }
                }
            });
        }, observerOptions);

        // Observe all scroll-animate elements
        const animateElements = document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale');
        animateElements.forEach(el => {
            observer.observe(el);
        });

        console.log(`Observing ${animateElements.length} elements for scroll animations`);
    } catch (error) {
        console.log('Scroll observer setup error:', error);
    }

    // Safe Counter Animation
    function animateCounter(element, target, duration = 1500) {
        try {
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                if (target >= 1000) {
                    element.textContent = Math.floor(current / 1000) + 'K+';
                } else {
                    element.textContent = Math.floor(current) + '+';
                }
            }, 16);
        } catch (error) {
            console.log('Counter animation error:', error);
            // Fallback: just show the target value
            if (target >= 1000) {
                element.textContent = Math.floor(target / 1000) + 'K+';
            } else {
                element.textContent = target + '+';
            }
        }
    }

    // Counter Observer
    try {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    try {
                        const counter = entry.target;
                        const target = parseInt(counter.dataset.target);
                        if (!isNaN(target) && target > 0) {
                            animateCounter(counter, target);
                        }
                        counterObserver.unobserve(counter);
                    } catch (error) {
                        console.log('Counter observer error:', error);
                    }
                }
            });
        }, { threshold: 0.5 });

        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            counterObserver.observe(counter);
        });

        console.log(`Setup ${counters.length} counters`);
    } catch (error) {
        console.log('Counter setup error:', error);
    }

    // Safe Button Interactions
    try {
        document.querySelectorAll('.btn-animate').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    } catch (error) {
        console.log('Button animation error:', error);
    }

    // Safe Parallax Effect
    let ticking = false;
    function updateParallax() {
        try {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax');
            
            parallaxElements.forEach(element => {
                const speed = parseFloat(element.dataset.speed) || 0.2;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        } catch (error) {
            console.log('Parallax error:', error);
        }
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });

    // Safe Smooth Scroll
    try {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    } catch (error) {
        console.log('Smooth scroll error:', error);
    }

    // Safe Ripple Effect
    function createRipple(event) {
        try {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');

            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        } catch (error) {
            console.log('Ripple error:', error);
        }
    }

    // Add ripple effect to buttons
    try {
        document.querySelectorAll('.btn-ripple').forEach(button => {
            button.addEventListener('click', createRipple);
        });
    } catch (error) {
        console.log('Ripple setup error:', error);
    }

    // Safe Floating Elements
    try {
        document.querySelectorAll('.animate-float, .animate-float-slow').forEach(element => {
            const randomDelay = Math.random() * 1;
            element.style.animationDelay = randomDelay + 's';
        });
    } catch (error) {
        console.log('Floating elements error:', error);
    }

    // Safe Page Load Animation
    window.addEventListener('load', () => {
        try {
            document.body.classList.add('loaded');
            
            const heroElements = document.querySelectorAll('.hero-animate');
            heroElements.forEach((element, index) => {
                setTimeout(() => {
                    try {
                        element.classList.add('animate-fade-in-up');
                    } catch (error) {
                        console.log('Hero animation error:', error);
                    }
                }, index * 100);
            });
        } catch (error) {
            console.log('Page load error:', error);
        }
    });

    console.log('Faciona animations loaded successfully!');
});

// Error handling for the entire script
window.addEventListener('error', function(e) {
    console.log('Animation script error:', e.error);
});
