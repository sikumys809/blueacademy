<?php
/**
 * Footer Template
 *
 * @package Blueacademy
 */
?>

</main><!-- /#content -->

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="site-footer-grid">

            <div class="site-footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php bloginfo( 'name' ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/blueacademy-logo.svg" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img">
                </a>
                <p class="site-footer-tagline">総合型選抜・推薦入試専門のオンライン予備校。脱偏差値×個性無双をスローガンに、全国の受験生をサポートしています。</p>
            </div>

            <div class="site-footer-col">
                <h4 class="site-footer-col-title">About</h4>
                <ul class="site-footer-list">
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">ブルーアカデミーとは</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/results/' ) ); ?>">合格実績</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/stories/' ) ); ?>">合格者体験記</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/teachers/' ) ); ?>">講師陣</a></li>
                </ul>
            </div>

            <div class="site-footer-col">
                <h4 class="site-footer-col-title">Information</h4>
                <ul class="site-footer-list">
                    <li><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">お知らせ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/tokushoho/' ) ); ?>">特定商取引法に基づく表記</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシーポリシー</a></li>
                </ul>
            </div>

            <div class="site-footer-col">
                <h4 class="site-footer-col-title">Contact</h4>
                <div class="site-footer-cta">
                    <a href="https://bit.ly/4uMMSR9" class="btn btn-primary" target="_blank" rel="noopener">無料受験相談</a>
                    <a href="https://bit.ly/4uJsAYy" class="btn btn-line" target="_blank" rel="noopener">LINE追加</a>
                </div>
            </div>

        </div>

        <div class="site-footer-bottom">
            <div class="site-footer-copy">© <?php echo esc_html( date( 'Y' ) ); ?> BLUE ACADEMY ／ CREA INC.</div>
            <div class="site-footer-meta">
                <a href="<?php echo esc_url( home_url( '/tokushoho/' ) ); ?>">特商法</a>
                <a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">プライバシー</a>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
