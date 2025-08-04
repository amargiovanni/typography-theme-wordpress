/**
 * Smooth scroll functionality
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll for anchor links
        const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
        
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    // Calculate offset for fixed header
                    const header = document.querySelector('.site-header');
                    const headerHeight = header ? header.offsetHeight : 0;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                    
                    // Smooth scroll to target
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL hash
                    if (history.pushState) {
                        history.pushState(null, null, targetId);
                    } else {
                        location.hash = targetId;
                    }
                    
                    // Move focus to target element for accessibility
                    targetElement.setAttribute('tabindex', '-1');
                    targetElement.focus();
                }
            });
        });

        // Smooth scroll to top button
        const scrollToTopButton = document.createElement('button');
        scrollToTopButton.innerHTML = '↑';
        scrollToTopButton.className = 'scroll-to-top fixed bottom-24 right-6 w-12 h-12 rounded-full opacity-0 invisible transition-all duration-300 focus:outline-none focus:ring-2 z-50';
        scrollToTopButton.setAttribute('aria-label', 'Scroll to top');
        document.body.appendChild(scrollToTopButton);

        // Show/hide scroll to top button
        let scrolling = false;
        
        window.addEventListener('scroll', function() {
            if (!scrolling) {
                window.requestAnimationFrame(function() {
                    if (window.pageYOffset > 300) {
                        scrollToTopButton.classList.remove('opacity-0', 'invisible');
                        scrollToTopButton.classList.add('opacity-100', 'visible');
                    } else {
                        scrollToTopButton.classList.add('opacity-0', 'invisible');
                        scrollToTopButton.classList.remove('opacity-100', 'visible');
                    }
                    scrolling = false;
                });
                scrolling = true;
            }
        });

        // Scroll to top functionality
        scrollToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Add smooth scroll behavior to the whole document
        if ('scrollBehavior' in document.documentElement.style) {
            document.documentElement.style.scrollBehavior = 'smooth';
        }

        // Handle initial hash on page load
        if (window.location.hash) {
            setTimeout(function() {
                const targetElement = document.querySelector(window.location.hash);
                if (targetElement) {
                    const header = document.querySelector('.site-header');
                    const headerHeight = header ? header.offsetHeight : 0;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }, 100);
        }
    });
})();