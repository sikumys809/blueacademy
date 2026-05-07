/**
 * Blue Academy — Mobile Menu Toggle
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.querySelector('.menu-toggle');
        const list = document.getElementById('primary-menu');

        if (!toggle || !list) return;

        toggle.addEventListener('click', function() {
            const isOpen = list.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            toggle.setAttribute('aria-label', isOpen ? 'メニューを閉じる' : 'メニューを開く');
        });

        list.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                list.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    });

})();