<?php
/**
 * The template for displaying the front page (TOP)
 *
 * @package Blueacademy
 */

get_header();
?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-meta">Blue Academy ／ Online Prep School for Comprehensive Selection</div>
    <div class="hero-grid">
      <div>
        <h1 class="hero-title">
          脱偏差値、<br>
          <span class="accent">個性無双</span><span class="period">.</span>
        </h1>
        <p class="hero-sub">
          総合型選抜・推薦入試の「受かり方」が分かる、<br>
          オンライン専門予備校。<br>
          北は北海道、南は沖縄まで。都市と地方の壁を消して、<br>
          全国から本気の受験生が集まっています。
        </p>
        <div class="hero-actions">
          <a href="https://utage-system.com/event/nLgsJEGf1Pff/register" class="btn btn-primary btn-arrow">無料受験相談を予約する</a>
          <a href="https://utage-system.com/line/open/6mWKcAJuw1Ke?mtid=07ij3JpYP7K4" class="btn btn-line btn-arrow">LINE追加で特典を受け取る</a>
        </div>
      </div>
      <div class="hero-stats">
        <div class="stat">
          <div class="stat-num">100<small>%</small></div>
          <div class="stat-label">第3志望までの合格率</div>
          <div class="stat-desc">2025年度・グループ全体実績</div>
        </div>
        <div class="stat">
          <div class="stat-num">93.3<small>%</small></div>
          <div class="stat-label">難関大学合格率</div>
          <div class="stat-desc">2025年度・グループ全体実績</div>
        </div>
        <div class="stat">
          <div class="stat-num">100<small>%</small></div>
          <div class="stat-label">慶應SFC 2次試験突破率</div>
          <div class="stat-desc">2025年度・グループ全体実績</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- INTRO STRIP -->
<section class="intro-strip">
  <div class="container">
    <p class="intro-text">
      早慶上理、GMARCH、日東駒専、成成明学、関関同立、<br>
      そして難関国公立まで。<span class="blue">「この大学群には強いが、あの大学群は弱い」</span><br>
      — そんな偏りはありません。志望校がどこであれ、最適解を設計できる。
    </p>
  </div>
</section>

<!-- STUDENTS (静的：Phase 4 で CPT 動的化予定) -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <div class="section-eyebrow">
        <span class="num">01</span>
        Success Stories
      </div>
      <div>
        <h2 class="section-title">
          Blue Academyから、<br>合格が次々と生まれている。
        </h2>
        <p class="section-lead">
          実績は数字だけじゃない。一人ひとりが、自分の物語で勝ち取った合格です。
        </p>
      </div>
    </div>

    <div class="students-grid">
      <article class="student-card">
        <div class="student-photo">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/student-onishi.jpg' ); ?>" alt="大西 彩桜さん">
        </div>
        <div class="student-num">FILE 05 ／ 全方式合格</div>
        <h3 class="student-uni">立命館アジア<br>太平洋大学</h3>
        <p class="student-name">大西 彩桜さん</p>
        <p class="student-quote">APUにしか進学したくないと一念発起。総合型のすべての方式で合格を勝ち取った努力家。</p>
      </article>

      <article class="student-card">
        <div class="student-photo">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/student-ikeda.jpg' ); ?>" alt="池田 伸雅さん">
        </div>
        <div class="student-num">FILE 07 ／ 単願合格</div>
        <h3 class="student-uni">上智大学<br>総合グローバル学部</h3>
        <p class="student-name">池田 伸雅さん</p>
        <p class="student-quote">日中バイリンガルが、上智一校に絞った単願出願で勝負。「言語力」で打ち勝った。</p>
      </article>

      <article class="student-card">
        <div class="student-photo">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/student-suzuki.jpg' ); ?>" alt="鈴木 蒼葉さん">
        </div>
        <div class="student-num">FILE 11 ／ 転塾2ヶ月</div>
        <h3 class="student-uni">明治大学<br>総合数理学部</h3>
        <p class="student-name">鈴木 蒼葉さん</p>
        <p class="student-quote">大手塾の遅すぎるカリキュラムに見切りをつけ転塾。2ヶ月で明治理系合格を掴んだ。</p>
      </article>

      <article class="student-card">
        <div class="student-photo">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/student-nakata.jpg' ); ?>" alt="中田 皓太さん">
        </div>
        <div class="student-num">FILE 08 ／ 1ヶ月逆転</div>
        <h3 class="student-uni">立命館アジア<br>太平洋大学</h3>
        <p class="student-name">中田 皓太さん</p>
        <p class="student-quote">一般受験は併願含め全滅。崖っぷちからの転塾で、1ヶ月という短期間で進路を一発逆転。</p>
      </article>
    </div>
  </div>
</section>

<!-- CTA BIG -->
<section class="cta-section">
  <div class="container">
    <div class="cta-eyebrow">／  Free Consultation</div>
    <h2 class="cta-title">
      無料受験相談で、<br>
      <span class="blue">「合格直結」</span>の有料級4大特典を手渡します。
    </h2>
    <p class="cta-text">
      迷っている時間は、ライバルとの差になる。<br>
      まず話を聞きに来てください。相談だけで、戦略の輪郭が見えるはずです。
    </p>

    <div class="benefits">
      <div class="benefit-card">
        <div class="benefit-img-wrap">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bonus-01.webp' ); ?>" alt="合格者の志望理由書10選">
        </div>
        <div class="benefit-num">Bonus 01</div>
        <div class="benefit-title">合格者の<br>志望理由書10選</div>
        <div class="benefit-desc">Blue Academyの総合型選抜対策で合格した志望理由書から厳選した10個を特別配布。</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-img-wrap">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bonus-02.webp' ); ?>" alt="参考書に載っていない面接質問集50選">
        </div>
        <div class="benefit-num">Bonus 02</div>
        <div class="benefit-title">参考書に載っていない<br>面接質問集50選</div>
        <div class="benefit-desc">面接でよく聞かれる質問50個を厳選紹介。本番に向けた実戦対策に直結する一冊。</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-img-wrap">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bonus-03.webp' ); ?>" alt="必勝小論文基礎問題集">
        </div>
        <div class="benefit-num">Bonus 03</div>
        <div class="benefit-title">必勝<br>小論文基礎問題集</div>
        <div class="benefit-desc">現代文の点数も上がる、2次試験で大事な基礎力を上げるすぐに文章が上達する問題集。</div>
      </div>
      <div class="benefit-card">
        <div class="benefit-img-wrap">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/bonus-04.webp' ); ?>" alt="逆転合格事例集">
        </div>
        <div class="benefit-num">Bonus 04</div>
        <div class="benefit-title">逆転合格<br>事例集</div>
        <div class="benefit-desc">評定が低い、課外活動ゼロからワンランク上の大学に合格した事例を公開。</div>
      </div>
    </div>

    <div class="cta-actions">
      <a href="https://utage-system.com/event/nLgsJEGf1Pff/register" class="btn btn-cta-primary btn-arrow">無料受験相談を予約する</a>
      <a href="https://utage-system.com/line/open/6mWKcAJuw1Ke?mtid=07ij3JpYP7K4" class="btn btn-cta-line btn-arrow">LINE追加で特典を受け取る</a>
    </div>
  </div>
</section>

<!-- TEACHERS (静的：Phase 4 で CPT 動的化予定) -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <div class="section-eyebrow">
        <span class="num">02</span>
        Instructors
      </div>
      <div>
        <h2 class="section-title">
          教えるのは、<br>社会で結果を出してきた大人たち。
        </h2>
        <p class="section-lead">
          総合型選抜が問うのは、「社会で通用する人間になれるか」。<br>
          だから指導側にも、社会の修羅場を知っている経験が要る。
        </p>
      </div>
    </div>

    <div class="teachers-grid">
      <?php
      $top_teachers = get_posts( array(
          'post_type'      => 'teacher',
          'post_status'    => 'publish',
          'posts_per_page' => 3,
          'meta_key'       => 'sort_order',
          'orderby'        => 'meta_value_num',
          'order'          => 'ASC',
      ) );
      foreach ( $top_teachers as $t ) :
          $tid       = $t->ID;
          $name_jp   = get_post_meta( $tid, 'name_jp', true );
          $position  = get_post_meta( $tid, 'position', true );
          $list_bio  = get_post_meta( $tid, 'list_bio_html', true );
          $bio_html  = get_post_meta( $tid, 'bio_html', true );
          $photo_id  = get_post_meta( $tid, 'photo', true );
          $photo_src = $photo_id ? wp_get_attachment_image_url( $photo_id, 'large' ) : '';

          // bio_html の最初の <p> 段落だけ取り出す（短い説明として）
          $desc_raw = '';
          if ( preg_match( '/<p>(.*?)<\/p>/s', $bio_html, $m ) ) {
              $desc_raw = $m[1];
          }
          // strong だけ残してその他のタグは削る、長すぎたら100文字で省略
          $desc = wp_kses( $desc_raw, array( 'strong' => array() ) );
          // 長すぎたら短縮（句点の位置で切れるよう優先）
          $desc_plain = wp_strip_all_tags( $desc );
          if ( mb_strlen( $desc_plain ) > 90 ) {
              $cut = mb_substr( $desc_plain, 0, 80 );
              $last_period = mb_strrpos( $cut, '。' );
              if ( $last_period !== false ) {
                  $desc = mb_substr( $desc_plain, 0, $last_period + 1 );
              } else {
                  $desc = $cut . '…';
              }
          }
      ?>
        <a href="<?php echo esc_url( get_permalink( $tid ) ); ?>" class="teacher-card">
          <div class="teacher-photo">
            <?php if ( $photo_src ) : ?>
              <img src="<?php echo esc_url( $photo_src ); ?>" alt="<?php echo esc_attr( $name_jp ); ?>">
            <?php endif; ?>
          </div>
          <?php if ( $position ) : ?>
            <div class="teacher-role"><?php echo esc_html( $position ); ?></div>
          <?php endif; ?>
          <h3 class="teacher-name"><?php echo esc_html( $name_jp ); ?></h3>
          <?php if ( $list_bio ) : ?>
            <p class="teacher-bio"><?php echo wp_kses_post( html_entity_decode( $list_bio ) ); ?></p>
          <?php endif; ?>
          <?php if ( $desc ) : ?>
            <p class="teacher-desc"><?php echo wp_kses_post( $desc ); ?></p>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- NEWS (動的：news CPT から最新4件取得) -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <div class="section-eyebrow">
        <span class="num">03</span>
        News
      </div>
      <div>
        <h2 class="section-title">お知らせ</h2>
        <p class="section-lead">
          ブルーアカデミーからの最新情報をお届けします。
        </p>
      </div>
    </div>

    <?php
    $news_posts = get_posts( array(
        'post_type'      => 'news',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    ?>

    <?php if ( ! empty( $news_posts ) ) : ?>
    <div class="news-list">
      <?php foreach ( $news_posts as $news_post ) :
          $news_id      = $news_post->ID;
          $external_url = function_exists( 'rwmb_meta' ) ? rwmb_meta( 'external_url', '', $news_id ) : '';
          $category     = function_exists( 'rwmb_meta' ) ? rwmb_meta( 'display_category', '', $news_id ) : '';
          $is_important = function_exists( 'rwmb_meta' ) ? rwmb_meta( 'is_important', '', $news_id ) : false;
          $link_url     = ! empty( $external_url ) ? $external_url : get_permalink( $news_id );
          $link_attrs   = ! empty( $external_url ) ? ' target="_blank" rel="noopener"' : '';
          $category     = ! empty( $category ) ? $category : 'Notice';
      ?>
        <a href="<?php echo esc_url( $link_url ); ?>" class="news-item<?php echo $is_important ? ' is-important' : ''; ?>"<?php echo $link_attrs; ?>>
          <div class="news-date"><?php echo esc_html( get_the_date( 'Y.m.d', $news_id ) ); ?></div>
          <div class="news-cat"><?php echo esc_html( $category ); ?></div>
          <div class="news-title"><?php echo esc_html( get_the_title( $news_id ) ); ?></div>
          <div class="news-arrow">→</div>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
    <p style="text-align: center; color: var(--muted); padding: 60px 0;">お知らせは現在準備中です。</p>
    <?php endif; ?>

    <div class="news-more">
      <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="btn btn-line btn-arrow">お知らせ一覧を見る</a>
    </div>
  </div>
</section>

<?php
get_footer();
