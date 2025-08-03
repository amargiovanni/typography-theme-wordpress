/**
 * Navigation JavaScript
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOpen = menuToggle.querySelector('.menu-open');
        const menuClose = menuToggle.querySelector('.menu-close');

        if (!menuToggle || !mobileMenu) {
            return;
        }

        // Toggle mobile menu
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            menuOpen.classList.toggle('hidden');
            menuClose.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.add('hidden');
                menuOpen.classList.remove('hidden');
                menuClose.classList.add('hidden');
            }
        });

        // Handle menu item clicks in mobile menu
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                menuToggle.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.add('hidden');
                menuOpen.classList.remove('hidden');
                menuClose.classList.add('hidden');
            });
        });

        // Add aria-current to current menu item
        const currentUrl = window.location.href;
        const menuLinks = document.querySelectorAll('.main-navigation a, .mobile-navigation a');
        
        menuLinks.forEach(function(link) {
            if (link.href === currentUrl) {
                link.setAttribute('aria-current', 'page');
                link.classList.add('current-menu-item');
            }
        });

        // Handle submenu accessibility
        const menuItems = document.querySelectorAll('.menu-item-has-children');
        
        menuItems.forEach(function(item) {
            const link = item.querySelector('a');
            const submenu = item.querySelector('.sub-menu');
            
            if (link && submenu) {
                // Add aria attributes
                link.setAttribute('aria-haspopup', 'true');
                link.setAttribute('aria-expanded', 'false');
                
                // Toggle submenu on click (for mobile)
                link.addEventListener('click', function(e) {
                    if (window.innerWidth < 1024) {
                        e.preventDefault();
                        const isExpanded = link.getAttribute('aria-expanded') === 'true';
                        link.setAttribute('aria-expanded', !isExpanded);
                        submenu.classList.toggle('hidden');
                    }
                });
            }
        });

        // Update aria-expanded on window resize
        let windowWidth = window.innerWidth;
        
        window.addEventListener('resize', function() {
            if (window.innerWidth !== windowWidth) {
                windowWidth = window.innerWidth;
                
                if (windowWidth >= 1024) {
                    // Desktop view: close mobile menu
                    menuToggle.setAttribute('aria-expanded', 'false');
                    mobileMenu.classList.add('hidden');
                    menuOpen.classList.remove('hidden');
                    menuClose.classList.add('hidden');
                }
            }
        });
    });
})();