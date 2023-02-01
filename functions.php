<?php

add_action('init', function () {
    //アイキャッチ画像をサポート
    add_theme_support('post-thumbnails');
});

//カスタムタクソノミー作成(Custom Post Type UI生成)
function cptui_register_my_cpts()
{

    /**
     * Post Type: このイベントについて.
     */

    $labels = [
        "name" => __("このイベントについて", "custom-post-type-ui"),
        "singular_name" => __("このイベントについて", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("このイベントについて", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "about", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail" ],
        "show_in_graphql" => false,
    ];

    register_post_type("about", $args);
}

add_action('init', 'cptui_register_my_cpts');


/**
* カテゴリーを1つだけ表示
*
* @param boolean $anchor aタグで出力するかどうか.
* @param integer $id 投稿id.
* @return void
*/
    
function my_the_post_category($anchor = true, $id = 0)
{
    global $post;
    //引数が渡されなければ投稿IDを見るように設定
    if (0 === $id) {
        $id = $post->ID;
    }
    
    //カテゴリー一覧を取得
    $this_categories = get_the_category($id);
    if ($this_categories[0]) {
        if ($anchor) { //引数がtrueならリンク付きで出力
            echo '<a href="' . esc_url(get_category_link($this_categories[0]->term_id)) . '">' . esc_html($this_categories[0]->cat_name) . '</a>';
        } else { //引数がfalseならカテゴリー名のみ出力
            echo esc_html($this_categories[0]->cat_name);
        }
    }
}

//pagination
function pagination($pages = '', $range = 2)
{
    $showitems = ($range * 1)+1;
    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        // 画像を使う時用に、テーマのパスを取得
        $img_pass = get_template_directory_uri();
        // 「1/2」表示 現在のページ数 / 総ページ数
        // echo "<div class=\"m-pagination__result\">". $paged."/". $pages."</div>";
        // 「前へ」を表示
        // if($paged > 1) echo "<div class=\"m-pagination__prev\"><a href='".get_pagenum_link($paged - 1)."'>前へ</a></div>";
        // ページ番号を出力
        echo "<ul class=\"details__pagination\">\n";
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
                echo ($paged == $i)? "<li class=\"details__pagination__item details__pagination__item--active\">".$i."</li>": // 現在のページの数字はリンク無し
                    "<li class=\"details__pagination__item\"><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
            }
        }
        // [...] 表示
        if (($paged + 4) < $pages) {
            echo "<li class=\"details__pagination__item details__pagination__item__dot\">...</li>";
            echo "<li class=\"details__pagination__item\"><a href='".get_pagenum_link($pages)."'>".$pages."</a></li>";
        }
        echo "</ul>\n";
        // 「次へ」を表示
        // if($paged < $pages) echo "<div class=\"m-pagination__next\"><a href='".get_pagenum_link($paged + 1)."'>次へ</a></div>";
    }
}