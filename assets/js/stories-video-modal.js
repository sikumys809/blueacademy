/**
 * Stories Media Modal
 *
 * - .story-video-thumb (button[data-video-id])  → YouTube embed
 * - .story-pdf-card    (button[data-pdf-url])   → FlipHTML5 / PDF iframe
 * 全画面オーバーレイで表示。ESC / ✕ / 背景クリックで閉じる。
 */
(function () {
  'use strict';

  function openMediaModal(opts) {
    var src = opts.src;
    if (!src) return;

    var modal = document.createElement('div');
    modal.className = 'video-modal';
    if (opts.kind === 'pdf') modal.classList.add('video-modal--pdf');

    modal.innerHTML =
      '<button class="video-modal-close" aria-label="閉じる"></button>' +
      '<div class="video-modal-frame">' +
        '<iframe src="' + src + '" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe>' +
      '</div>';

    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';

    function close() {
      if (!modal.parentNode) return;
      modal.remove();
      document.body.style.overflow = '';
      document.removeEventListener('keydown', escHandler);
    }
    function escHandler(e) {
      if (e.key === 'Escape' || e.keyCode === 27) close();
    }

    modal.querySelector('.video-modal-close').addEventListener('click', close);
    modal.addEventListener('click', function (e) {
      if (e.target === modal) close();
    });
    document.addEventListener('keydown', escHandler);
  }

  document.addEventListener('DOMContentLoaded', function () {
    // YouTube
    document.querySelectorAll('.story-video-thumb').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var id = btn.getAttribute('data-video-id');
        if (!id) return;
        openMediaModal({
          kind: 'video',
          src: 'https://www.youtube.com/embed/' + encodeURIComponent(id) + '?autoplay=1&rel=0'
        });
      });
    });

    // PDF (FlipHTML5)
    document.querySelectorAll('.story-pdf-card').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var url = btn.getAttribute('data-pdf-url');
        if (!url) return;
        openMediaModal({ kind: 'pdf', src: url });
      });
    });
  });
})();
