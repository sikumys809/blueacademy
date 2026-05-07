/**
 * Blue Academy — PDF Modal
 */
(function() {
    'use strict';

    function openPdfModal(url) {
        const existing = document.querySelector('.pdf-modal');
        if (existing) existing.remove();

        const modal = document.createElement('div');
        modal.className = 'pdf-modal';
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-modal', 'true');
        modal.setAttribute('aria-label', 'PDFビューアー');
        modal.innerHTML =
            '<button class="pdf-modal-close" type="button" aria-label="閉じる"></button>' +
            '<div class="pdf-modal-frame">' +
                '<iframe src="' + url + '" allowfullscreen></iframe>' +
            '</div>';

        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';

        function closeModal() {
            modal.remove();
            document.body.style.overflow = '';
            document.removeEventListener('keydown', onKeyDown);
        }

        function onKeyDown(e) {
            if (e.key === 'Escape') closeModal();
        }

        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.classList.contains('pdf-modal-close')) {
                closeModal();
            }
        });

        document.addEventListener('keydown', onKeyDown);
    }

    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('[data-pdf-url]');
        if (!trigger) return;
        const url = trigger.getAttribute('data-pdf-url');
        if (!url) return;
        e.preventDefault();
        openPdfModal(url);
    });

})();