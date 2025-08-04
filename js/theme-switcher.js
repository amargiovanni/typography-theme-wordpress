(function() {
    'use strict';

    // Check for saved theme preference or default to system preference
    const getSavedTheme = () => localStorage.getItem('theme');
    const saveTheme = (theme) => localStorage.setItem('theme', theme);

    // Apply theme to document
    const applyTheme = (theme) => {
        if (theme === 'dark' || theme === 'light') {
            document.documentElement.setAttribute('data-theme', theme);
        } else {
            document.documentElement.removeAttribute('data-theme');
        }
    };

    // Initialize theme
    const initTheme = () => {
        const savedTheme = getSavedTheme();
        
        if (savedTheme) {
            applyTheme(savedTheme);
        } else {
            // If no saved preference, the CSS will automatically use system preference
            applyTheme('auto');
        }
    };

    // Toggle theme
    const toggleTheme = () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        let newTheme;
        
        if (!currentTheme || currentTheme === 'auto') {
            // If auto, switch to opposite of system preference
            newTheme = systemPrefersDark ? 'light' : 'dark';
        } else if (currentTheme === 'light') {
            newTheme = 'dark';
        } else {
            newTheme = 'light';
        }
        
        applyTheme(newTheme);
        saveTheme(newTheme);
        
        // Update button icon if exists
        updateThemeButton(newTheme);
    };

    // Update theme button icon
    const updateThemeButton = (theme) => {
        const button = document.getElementById('theme-toggle');
        if (!button) return;
        
        const sunIcon = button.querySelector('.theme-icon-sun');
        const moonIcon = button.querySelector('.theme-icon-moon');
        
        if (!sunIcon || !moonIcon) return;
        
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }
    };

    // Create theme toggle button
    const createThemeButton = () => {
        const button = document.createElement('button');
        button.id = 'theme-toggle';
        button.className = 'theme-toggle fixed bottom-6 right-6 p-3 rounded-full shadow-lg transition-all duration-300 z-50';
        button.setAttribute('aria-label', 'Toggle dark mode');
        button.style.backgroundColor = 'rgb(var(--color-accent))';
        button.style.color = 'rgb(var(--color-bg-primary))';
        
        button.innerHTML = `
            <svg class="theme-icon-sun w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg class="theme-icon-moon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        `;
        
        button.addEventListener('click', toggleTheme);
        document.body.appendChild(button);
        
        // Set initial icon
        const savedTheme = getSavedTheme();
        updateThemeButton(savedTheme || 'auto');
    };

    // Listen for system theme changes
    const watchSystemTheme = () => {
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        
        mediaQuery.addEventListener('change', (e) => {
            const savedTheme = getSavedTheme();
            
            // Only update if user hasn't manually set a preference
            if (!savedTheme || savedTheme === 'auto') {
                updateThemeButton(e.matches ? 'dark' : 'light');
            }
        });
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initTheme();
            createThemeButton();
            watchSystemTheme();
        });
    } else {
        initTheme();
        createThemeButton();
        watchSystemTheme();
    }

    // Also run immediately to prevent flash of wrong theme
    initTheme();
})();