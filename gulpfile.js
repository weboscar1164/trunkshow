// 各モジュールの読み込み
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
sass.compiler = require("dart-sass"); // sassのコンパイルにdart-sassを使用する
const rename = require('gulp-rename');
const autoprefixer = require("gulp-autoprefixer");

// sassコンパイルの設定
function sassCompile(){
  return (
    gulp 
      // 読み込みファイルをセット
      .src('sass/style.scss')
      // コンパイルの実行
      .pipe(sass())
      // 書き出すファイル名を指定
      .pipe(rename('style.css'))
      // 指定した場所にcssを書き出し
      .pipe(gulp.dest('css'))
      //gulp-autoprefixer設定
      .pipe(autoprefixer({
          cascade: false,
          grid: true
		}))
  )
}
// "sassCompile"として使用する
exports.sassCompile = sassCompile;

function watch(){
  gulp.watch('sass',sassCompile);
}

// "npx gulp"でwatchを実行する
exports.default = watch;