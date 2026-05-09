/**
 * Page TOC Auto-generator
 *
 * page.php の .page-prose 内 h2 を拾って .page-prose-toc に注入。
 * h2 が1個も無ければ aside の hidden 属性を維持（非表示）。
 * クリックでスムーススクロール。
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var aside = document.getElementById('page-toc-aside');
    var list  = document.getElementById('page-toc-list');
    var prose = document.getElementById('page-prose-content');

    if (!aside || !list || !prose) return;

    var headings = prose.querySelectorAll('h2');
    if (headings.length === 0) return; // h2なし→hidden維持

    // h2にid付与＆目次li生成
    headings.forEach(function (h2, i) {
      if (!h2.id) {
        h2.id = 'toc-h2-' + (i + 1);
      }
      var li = document.createElement('li');
      var a  = document.createElement('a');
      a.href = '#' + h2.id;
      a.textContent = h2.textContent.trim();
      a.addEventListener('click', function (e) {
        e.preventDefault();
        var target = document.getElementById(h2.id);
        if (!target) return;
        var offset = 80; // ヘッダー分の余白
        var top = target.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top: top, behavior: 'smooth' });
        history.replaceState(null, '', '#' + h2.id);
      });
      li.appendChild(a);
      list.appendChild(li);
    });

    aside.removeAttribute('hidden');
  });
})();
