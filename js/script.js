//mainvisual
var sld = '.sld', //スライドにclass付与
sldPre = 'sld', //スライドのidにナンバリングして付与
sldTime = 2000, //fadein / outの時間
    sldWait = 5000, //スライド切り替え時間
    splash_text = jQuery.cookie('accessdate'), //キーが入っていれば年月日を取得
    myD = new Date(),//日付データを取得
    myYear = String(myD.getFullYear()),//年
    myMonth = String(myD.getMonth() + 1),//月
    myDate = String(myD.getDate());//日

jQuery(window).on('load', function () {
    if (splash_text != myYear + myMonth + myDate) {//cookieデータとアクセスした日付を比較↓
        jQuery("#splash").css("display", "block");//１回目はローディングを表示
        //ローディング時にロゴ表示    
        jQuery("#splash").delay(1500).fadeOut('slow');//ローディング画面を1.5秒（1500ms）待機してからフェードアウト
        jQuery("#splash_logo").delay(1200).fadeOut('slow');//ロゴを1.2秒（1200ms）待機してからフェードアウト
        
    }else {
        jQuery("#splash").css("display", "none");//同日2回目のアクセスでローディング画面非表示
    }
    
//最初のスライドを直ちに表示
    var sldNum = 2;
    jQuery('#sld1').show();
    setTimeout(() => {
        jQuery('#sld1').addClass('fadeImg');

    }, 1500);

//スライド切り替え時間を設定して繰り返し
//cssで.fadeImg作成
    setTimeout(() => {
        
        setInterval(() => {
            jQuery(sld).not(`#${sldPre}${sldNum}`).fadeOut(sldTime);
            jQuery(`#${sldPre}${sldNum}`).removeClass('fadeImg');
            jQuery(`#${sldPre}${sldNum}`).fadeIn(sldTime);
            jQuery(`#${sldPre}${sldNum}`).addClass('fadeImg');
        
            sldNum++;
            if (sldNum > jQuery(sld).length) {
                sldNum = 1;
            }
        }, sldWait);
    },5000)
});

//ナビゲーション操作
const navBtn = jQuery('.jsNavBtn'),
    navToggleBtn = jQuery('.header__nav__btn'),
    navToggle = jQuery('.header__nav__sp'),
    toTop = jQuery('.totop'),
    detailBtn = jQuery('.jsDetailBtn'),
    detailLink = jQuery('.details__link');

////リンククリックによってスムーススクロール
navBtn.on('click', event => {
    thisId = jQuery(event.currentTarget).attr('href');
    position = jQuery(thisId).offset().top;
    jQuery('html, body').animate({
        'scrollTop': position - 60
    }, 1000);

    ////(SPの場合)スクロール後にスライダーを閉じる
    setTimeout(function(){
        navToggleBtn.removeClass('header__nav__btn--active');
        navToggle.removeClass('header__nav__sp--active');
    }, 1000);
});

//navtoggle
navToggleBtn.on('click', event => {
    if (navToggleBtn.hasClass('header__nav__btn--active')) {
        navToggleBtn.removeClass('header__nav__btn--active');
        navToggle.removeClass('header__nav__sp--active');
    } else {
        navToggleBtn.addClass('header__nav__btn--active');
        navToggle.addClass('header__nav__sp--active');
    }
});

//totop移動
toTop.on('click', event => {
    jQuery('html, body').animate({
        'scrollTop': 0
    }, 1000);
});

////claft/food移動 
detailBtn.on('click', event => {
    thisId = jQuery(event.currentTarget).attr('href');
    position = jQuery(thisId).offset().top;
    jQuery('html, body').animate({
        'scrollTop': position - 150
    }, 1000);
});

//スクロールによってスクロールボタンを隠す
jQuery(window).on('load scroll', event => {
    if (jQuery(event.currentTarget).scrollTop() >= 200) {
        detailLink.fadeIn();
        toTop.fadeIn();
        
    } else {
        detailLink.fadeOut();
        toTop.fadeOut();
        }
});