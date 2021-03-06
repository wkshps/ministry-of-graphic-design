var gulp         = require('gulp'),
    gutil        = require('gulp-util'),
    plugins      = require('gulp-load-plugins')({ camelize: true }),
    del          = require('del'),
    autoprefixer = require('autoprefixer'),
    merge        = require('merge-stream'),
    browserSync  = require('browser-sync'),
    project      = 'fikra',
    src          = './src/',
    build        = './build/',
    dist         = './dist/' + project + '/',
    assets       = './assets/',
    bower        = './bower_components/',
    modules      = './node_modules/';

gulp.task('images', function() {
  return gulp.src([src + '**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)'])
  .pipe(plugins.changed(build))
  .pipe(gulp.dest(build));
});

gulp.task('images-optimize', ['utils-dist'], function() {
  return gulp.src([dist + '**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)', '!' + dist + 'screenshot.png'])
  .pipe(plugins.imagemin({
    optimizationLevel: 7
  }))
  .pipe(gulp.dest(dist));
});

gulp.task('scripts-lint', function() {
  return gulp.src([src + 'js/**/*.js']);
  //.pipe(plugins.jshint())
  //.pipe(plugins.jshint.reporter('default'));
});

gulp.task('scripts-watch', ['scripts'], browserSync.reload);

gulp.task('scripts-bundle', ['scripts-lint'], function() {
  return gulp.src([
    modules + 'imagesloaded/imagesloaded.pkgd.js',
    modules + 'slick-carousel/slick/slick.js',
    modules + 'rangeslider.js/dist/rangeslider.js',
    modules + 'js-cookie/src/js.cookie.js',
    modules + 'masonry-layout/dist/masonry.pkgd.js',
    modules + 'vanilla-fitvids/jquery.fitvids.js',
    src + 'js/core.js'
  ])
  .pipe(plugins.concat(project + '.min.js'))
  .pipe(gulp.dest(build + 'js/'));
});

gulp.task('scripts-minify', ['scripts-bundle'], function() {
  return gulp.src(build + 'js/**/*.js')
  .pipe(plugins.sourcemaps.init())
  .pipe(plugins.uglify())
  .pipe(plugins.sourcemaps.write('./'))
  .pipe(gulp.dest(build + 'js/'));
});

gulp.task('scripts', ['scripts-minify']);

gulp.task('styles', function() {
  return gulp.src([src + 'scss/**/*.scss'])
  .pipe(plugins.sourcemaps.init())
  .pipe(plugins.sass({
    includePaths: ['./src/scss', modules, bower],
    precision: 6,
    onError: function(err) {
      return console.log(err);
    }
  }))
  .pipe(plugins.postcss([ autoprefixer({ browsers: ['last 2 versions'] }) ]))
  .pipe(plugins.cssnano({ safe: true }))
  .pipe(plugins.sourcemaps.write('./'))
  .pipe(gulp.dest(build))
  .pipe(plugins.filter(['**/*.css']))
  .pipe(browserSync.stream());
});

gulp.task('theme', function() {
  return gulp.src(src + '**/*(*.html|*.twig|*.php|*.eot|*.ttf|*.woff|*.woff2|*.css)')
  .pipe(plugins.changed(build))
  .pipe(gulp.dest(build));
});

gulp.task('utils-wipe', ['setup'], function() {
  return del([dist]);
});

gulp.task('utils-clean', ['build', 'utils-wipe'], function() {
  return del([build + '**/.DS_Store']);
});

gulp.task('utils-dist', ['utils-clean'], function() {
  return gulp.src([build + '**/*', '!' + build + '**/*.map'])
  .pipe(gulp.dest(dist));
});

gulp.task('watch', ['build'], function() {
  browserSync.init({
    proxy: 'fikra:8888',
    open: false,
    notify: false,
    snippetOptions: {
      rule: {
        match: /<\/head>/i,
        fn: function (snippet, match) {
          return snippet + match;
        }
      }
    }
  });
  gulp.watch(src + 'scss/**/*.scss', ['styles']);
  gulp.watch(src + 'js/**/*.js', ['scripts-watch']);
  gulp.watch(src + '**/*(*.png|*.jpg|*.jpeg|*.gif|*.svg)', ['images']);
  gulp.watch(src + '**/*(*.html|*.php|*.twig|*.eot|*.ttf|*.woff|*.woff2|*.css)', ['theme']).on('change', browserSync.reload);
});

gulp.task('default', ['watch']);
gulp.task('build', ['images', 'scripts', 'styles', 'theme']);
gulp.task('dist', ['images-optimize']);
