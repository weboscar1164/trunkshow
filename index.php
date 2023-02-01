<?php get_header(); ?>
<?php get_template_part('./template/template_header'); ?>

<section class="details section__padding">
    <div class="section__container datail__container">
        <h2 class="section__title section__title__dark">ニュース<span>News</span></h2>
        <ul class="details__items">
            <?php if (have_posts()): ?>
            <?php while (have_posts()):
                the_post(); ?>
            <li class="details__item">

                <p class="details__item__img">
                    <?php if (has_post_thumbnail()):
                                // アイキャッチ画像が設定されていれば大サイズで表示
                                the_post_thumbnail();?>
                    <?php else:
                                // なければnoimage画像をデフォルトで表示?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/no-img.jpg" alt="">
                    <?php endif; ?>
                </p>
                <h3 class="details__item__title"><?php the_title() ?></h3>
                <?php if (in_category(array('クラフト', 'フード'))): ?>
                <p class="details__item__text"><?php the_field('name') ?></p>
                <?php endif; ?>
                <p class="details__item__text">
                    <?php the_excerpt(); ?>
                </p>
            </li>
            <?php endwhile; ?>
            <?php else: ?>
            <p class="detaile__item__text">投稿はありません</p>
            <?php endif ?>
        </ul>

        <?php
                // 関数が定義されていたらtrueになる
                if (function_exists('pagination')) {
                    pagination();
                }?>

</section>

<section class="totop">
    <div class="totop__btn">
        To Top
    </div>
</section>

<?php get_template_part('./template/template-footer') ?>
<?php get_footer(); ?>