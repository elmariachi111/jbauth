var gulp = require("gulp"),//http://gulpjs.com/
  util = require("gulp-util"),//https://github.com/gulpjs/gulp-util
  sass = require("gulp-sass"),//https://www.npmjs.org/package/gulp-sass
  autoprefixer = require('gulp-autoprefixer'),//https://www.npmjs.org/package/gulp-autoprefixer
  minifycss = require('gulp-minify-css'),//https://www.npmjs.org/package/gulp-minify-css
  rename = require('gulp-rename'),//https://www.npmjs.org/package/gulp-rename
  log = util.log;

gulp.task('default', ['sass', 'fonts'], function() {
  // place code for your default task here
});

gulp.task('fonts', function() {
  gulp.src('node_modules/bootstrap-sass/assets/fonts/*/*')
    .pipe(gulp.dest("web/fonts"))
});

gulp.task("sass", function(){
  log("Generate CSS files " + (new Date()).toString());
  gulp.src('app/Resources/public/scss/*.scss')
    .pipe(sass({ style: 'expanded' }))
    .pipe(autoprefixer("last 3 version","safari 5", "ie 8", "ie 9"))
    .pipe(gulp.dest("web/css"))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('web/css'));
});
gulp.task("watch", function(){
  gulp.watch('app/Resources/public/scss/*.scss', ["sass"]);
});
