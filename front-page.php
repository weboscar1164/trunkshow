<?php get_header() ?>

<body>
    <div id="splash">
        <div id="splash_logo">
            <img src="<?php echo get_template_directory_uri(); ?>/img/loadingicon.svg" alt="" class="fadeUp">
        </div>
    </div>
    <header class="header">
        <div class="header__logo">
            <a class="jsNavBtn" href="#top">The Trunk Show</a>
        </div>

        <div class="header__nav__pc">
            <ul class="header__nav__pc__list">
                <li class="header__nav__pc__item"><a class="jsNavBtn" href="#top"><span>Top</span>トップ</a></li>
                <li class="header__nav__pc__item"><a class="jsNavBtn" href="#about"><span>About</span>イベントについて</a></li>
                <li class="header__nav__pc__item"><a class="jsNavBtn" href="#list"><span>List</span>出展者情報</a></li>
                <li class="header__nav__pc__item"><a class="jsNavBtn" href="#map"><span>Map</span>会場案内</a></li>
                <li class="header__nav__pc__item"><a class="jsNavBtn" href="#access"><span>Acess</span>アクセス</a></li>
            </ul>
        </div>
        <ul class="header__right">
            <li class="header__right__item">
                <a href="https://www.facebook.com/trunkshowinkitoushi/" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/fbicon-green.svg" alt="">
                </a>
            </li>
            <li class="header__right__item">
                <a href="https://www.instagram.com/the_trunk_show_in_kitoushi/?hl=af" target="_blank"
                    rel="noopener noreferrer">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/instaicon-green.svg" alt="">
                </a>
            </li>
            <li class="header__right__item header__nav__btn">
                <span class="header__nav__btn__line"></span>
            </li>
        </ul>
        <div class="header__nav__sp">
            <ul class="header__nav__sp__list">
                <li class="header__nav__sp__item"><a class="jsNavBtn" href="#top"><span>Top</span>トップ</a></li>
                <li class="header__nav__sp__item"><a class="jsNavBtn" href="#about"><span>About</span>イベントについて</a></li>
                <li class="header__nav__sp__item"><a class="jsNavBtn" href="#list"><span>List</span>出展者情報</a></li>
                <li class="header__nav__sp__item"><a class="jsNavBtn" href="#map"><span>Map</span>会場案内</a></li>
                <li class="header__nav__sp__item"><a class="jsNavBtn" href="#access"><span>Acess</span>アクセス</a></li>
            </ul>
        </div>
    </header>

    <section id="top" class="mainvisual section__padding">
        <div id="sld1" class="sld mainvisual__bg mainvisual__bg1"></div>
        <div id="sld2" class="sld mainvisual__bg mainvisual__bg2"></div>
        <div id="sld3" class="sld mainvisual__bg mainvisual__bg3"></div>
        <div class="section__container mainvisual__container">
            <h1 class="mainvisual__title">
                The Trunk Show<br>
                in<br>
                Kitoushino 森
            </h1>
            <div class="mainvisual__wrapper">
                <?php
                    $posts = get_posts(array(
                        'posts_per_page' => 1,     //1件表示
                        'category_name' => 'date' // カテゴリIDもしくはスラッグ名
                        ));
                ?>
                <?php if ($posts): foreach ($posts as $post): setup_postdata($post); ?>
                <p class="mainvisual__text">
                    <?php the_field('event_date') ?><br>
                    上川キトウシ森林公園<br>
                    （上川郡東川町西5号北44）
                </p>
                <?php endforeach; else: ?>
                <p class="mainvisual__text">
                    開催日：Coming soon!<br>
                    上川キトウシ森林公園<br>
                    （上川郡東川町西5号北44）
                </p>
                <?php endif; wp_reset_postdata(); ?>
                <a href="<?php echo esc_url(home_url('/list')); ?>" class="section__btn mainvisual__btn">出展者情報を見る</a>
            </div>
            <div class="mainvisual__news">
                <h2 class="mainvisual__news__title">NEWS</h2>
                <ul class="mainvisual__news__list">
                    <?php if (have_posts()): ?>
                    <?php  $args = array(
    'posts_per_page' => 3 // 表示件数の指定
  );
  $posts = get_posts($args);
  foreach ($posts as $post): // ループの開始
  setup_postdata($post); // 記事データの取得?>
                    <li class="mainvisual__news__item">
                        <p class="mainvisual__news__date"><?php the_time(get_option('date_format')); ?></p>
                        <p class="mainvisual__news__content"><?php the_title(); ?></p>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="detaile__item__text">投稿はありません</p>
                    <?php endif;  wp_reset_postdata(); ?>

                </ul>
            </div>

            <a href="<?php echo esc_url(home_url('/news')); ?>" class="mainvisual__news__link">詳しく見る</a>
        </div>
    </section>
    <!-- mainvisual -->

    <section id="about" class="about section__padding">
        <div class="section__container">
            <h2 class="section__title section__title__dark">このイベントについて<span>About</span></h2>
            <?php
            $about_post = new WP_Query(array(
                'paged' => $paged,
                'post_type' => 'about',
                'posts_per_page' => 1
            ));
            ?>
            <?php if ($about_post -> have_posts()):
                     while ($about_post -> have_posts()) :
                     $about_post -> the_post(); ?>
            <p class="about__img">
                <?php if (has_post_thumbnail()):
                                // アイキャッチ画像が設定されていれば大サイズで表示
                                the_post_thumbnail();?>
                <?php else:
                                // なければnoimage画像をデフォルトで表示?>
                <img src="<?php esc_url(get_template_directory_uri()) ?>/img/no-img.jpg" alt="">
                <?php endif; ?>
            </p>
            <div class="about__contents">




                <h3 class="about__contents__title"><?php the_title() ?></h3>
                <p class="about__contents__text"><?php the_content() ?></p>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <!-- about -->

    <section id="list" class="list section__padding">
        <div class="section__container">
            <h2 class="section__title section__title__light">出展者一覧<span>List</span></h2>
            <p class="list__text">様々なジャンルの作家さんが集まります。</p>
            <a href="<?php echo esc_url(home_url('/list')); ?>" class="section__btn list__btn">出展者情報を見る</a>
        </div>
    </section>
    <!-- list -->

    <section id="map" class="map section__padding">
        <div class="section__container">
            <h2 class="section__title section__title__dark">会場案内<span>Map</span></h2>
            <p class="map__text">会場内の見取り図です。</p>
            <?php
                    $posts = get_posts(array(
                        'posts_per_page' => 1,     //1件表示
                        'category_name' => 'map' // カテゴリIDもしくはスラッグ名
                        ));
                ?>
            <?php if ($posts): foreach ($posts as $post): setup_postdata($post); ?>
            <p class="map__img">
                <?php if (has_post_thumbnail()):
                                // アイキャッチ画像が設定されていれば大サイズで表示
                                the_post_thumbnail();?>
                <?php else:
                                // なければnoimage画像をデフォルトで表示?>
                <img src="<?php esc_url(get_template_directory_uri()) ?>/img/no-img.jpg" alt="">
                <?php endif; ?>
            </p>
            <?php endforeach; endif; wp_reset_postdata(); ?>
        </div>
    </section>
    <!-- map -->

    <section id="access" class="access section__padding">
        <div class="section__container">
            <h2 class="section__title section__title__light">アクセス<span>Access</span></h2>
            <p class="access__text">
                キトウシ森林公園<br>
                上川郡東川町西5号北44
            </p>
            <div class="access__iframe">
                <iframe
                    src="&#104;tt&#112;s&#58;&#47;&#47;//www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1441.5863352165063!2d142.53453141971733!3d43.72773971237231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sja!2sjp!4v1626526433782!5m2!1sja!2sjp"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <a class="access__iframe__icon"
                    href="https://www.google.co.jp/maps/@43.7277397,142.5345314,18z/data=!5m1!1e1?hl=ja&authuser=0"
                    target="_blank" rel="noopener noreferrer">
                    <img src=" <?php echo get_template_directory_uri(); ?>/img/mapicon.svg" alt="">
                </a>
            </div>
            <a href="https://www.google.co.jp/maps/@43.7277397,142.5345314,18z/data=!5m1!1e1?hl=ja&authuser=0"
                target="_blank" rel="noopener noreferrer" class="section__btn access__btn">Googleマップを見る</a>
        </div>
    </section>
    <!-- access -->
    <?php
        $posts = get_posts(array(
            'posts_per_page' => -1,     //全件表示
            'category_name' => 'media' // カテゴリIDもしくはスラッグ名
            ));
        ?>
    <?php if ($posts): ?>
    <section class="media section__padding">
        <div class="section__container">
            <h2 class="section__title section__title__light">メディア<span>Media</span></h2>
            <p class="media__text">
                <span>The Trunk Showが<br>
                    メディアに紹介されました。</span>
            </p>
            <ul class="media__list">
                <?php foreach ($posts as $post): setup_postdata($post); ?>
                <li class="media__list__item"><a href="<?php esc_url(the_field('url')) ?>" target="_blank"
                        rel="noopener noreferrer">
                        <img src="<?php the_field('bunner') ?>">
                    </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); ?>
    <!-- media -->


    <section class="totop">
        <div class="totop__btn">
            To Top
        </div>
    </section>
    <footer class="footer">
        <div class="section__container section__padding">
            <h2 class="footer__logo">The Trunk Show</h2>
            <div class="footer__wrapper">
                <p class="footer__text">
                    Trunk Show 実行委員会<br>　
                    須田 090-8899-6561<br>
                    sweetspice.naenae@gmail.com
                </p>
                <nav class="footer__nav">
                    <ul class="footer__nav__list">
                        <li class="footer__nav__item footer__nav__text"><a class="jsNavBtn" href="#top">Top</a></li>
                        <li class="footer__nav__item footer__nav__text"><a class="jsNavBtn" href="#about">About</a></li>
                        <li class="footer__nav__item footer__nav__text"><a class="jsNavBtn" href="#list">List</a></li>
                        <li class="footer__nav__item footer__nav__text"><a class="jsNavBtn" href="#map">Map</a></li>
                        <li class="footer__nav__item footer__nav__text"><a class="jsNavBtn" href="#access">Access</a>
                        </li>
                        <li class="footer__nav__item footer__nav__icon">
                            <a href="https://www.facebook.com/trunkshowinkitoushi/" target="_blank"
                                rel="noopener noreferrer">
                                <img src=" <?php echo get_template_directory_uri(); ?>/img/fbicon-green.svg" alt="">
                            </a>
                        </li>
                        <li class="footer__nav__item footer__nav__icon">
                            <a href="https://www.instagram.com/the_trunk_show_in_kitoushi/?hl=af" target="_blank"
                                rel="noopener noreferrer">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/instaicon-green.svg" alt="">
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer__copy">
            <small class="footer__copy__small">©Trunk Show</small>
        </div>
    </footer>
</body>
<?php get_footer() ?>