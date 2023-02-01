<?php get_header(); ?>
<?php get_template_part('./template/template_header'); ?>

<section class="details section__padding">
    <div class="section__container datail__container">
        <h2 class="section__title section__title__dark">出展者紹介<span>List</span></h2>
        <h2 id="crafts" class="details__subtitle">クラフト<span>Clafts</span></h2>
        <ul class="details__items">
            <?php
                    $posts = get_posts(array(
                        'posts_per_page' => -1,     //全件表示
                        'category_name' => 'crafts' // カテゴリIDもしくはスラッグ名
                        ));
                        ?>
            <?php if ($posts): foreach ($posts as $post): setup_postdata($post); ?>
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
                <h3 class="details__item__title"><?php the_field('name') ?></h3>
                <p class="details__item__text"><?php the_field('category') ?></p>
                <p class="details__item__text">
                    <?php the_content() ?>
                </p>
            </li>
            <?php endforeach; endif; wp_reset_postdata(); ?>

        </ul>
        <h2 id="foods" class="details__subtitle">フード<span>Foods</span></h2>
        <ul class="details__items">
            <?php
                    $posts = get_posts(array(
                        'posts_per_page' => -1,     //全件表示
                        'category_name' => 'foods' // カテゴリIDもしくはスラッグ名
                        ));
                ?>
            <?php if ($posts): foreach ($posts as $post): setup_postdata($post); ?>
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
                <h3 class="details__item__title"><?php the_field('name') ?></h3>
                <p class="details__item__text"><?php the_field('category') ?></p>
                <p class="details__item__text">
                    <?php the_content() ?>
                </p>
            </li>
            <?php endforeach; endif; wp_reset_postdata(); ?>

        </ul>
    </div>
</section>

<section class="details__link">
    <div class="details__link__btn__wrapper">
        <a href="#crafts" class="jsDetailBtn details__link__btn details__link__crafts"><span>Clafts</span>クラフト</a>
        <a href="#foods" class="jsDetailBtn details__link__btn details__link__foods"><span>Foods</span>フード</a>
    </div>
</section>

<?php get_template_part('./template/template-footer') ?>
<?php get_footer(); ?>