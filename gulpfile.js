//
// Vars -----------------------------------------
//

var gulp = require('gulp');
var htmlmin = require('gulp-htmlmin');
var debug = require('gulp-debug');
var plumber = require('gulp-plumber');

//
// Requires -------------------------------------
//

require('laravel-elixir-vue');

//
// Elixir ---------------------------------------
//

const elixir = require('laravel-elixir');

elixir(function (mix) {
  // Fontes
  mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
    .copy('node_modules/font-awesome/fonts', 'public/build/fonts');

  // Imagens
  mix.copy('resources/assets/img', 'public/img')
    .copy('node_modules/fancybox/dist/img', 'public/img')
    .copy('node_modules/fancybox/dist/img', 'public/build/img')
    .copy('resources/assets/img', 'public/build/img');

  // SaSS/CSS
  mix.sass([
    'resources/assets/sass/cpanel/cpanel.scss',
    'node_modules/fancybox/dist/scss/jquery.fancybox.scss',
    'node_modules/jquery-topalert/topalert.css',
    'node_modules/sweetalert2/dist/sweetalert2.css'
  ], 'public/css/cpanel.css', __dirname);

  // Scripts
  mix.webpack([
    'resources/assets/js/cpanel/cpanel.js',
    'node_modules/jquery-formlink/jquery.formlink.js',
    'node_modules/jquery-topalert/jquery.topalert.js',
    'node_modules/fancybox/dist/js/jquery.fancybox.pack.js',
    'resources/assets/js/_common/uplab.js',
    'resources/assets/js/cpanel/tweaks.js'
  ], 'public/js/cpanel.js', __dirname);

  // Version
  mix.version([
    'public/js/cpanel.js',
    'public/css/cpanel.css'
  ]);

  // browserSync
  mix.browserSync({
    proxy: 'centraljogos.dev',
    open: true,
    logConnections: true,
    reloadOnRestart: true,
    notify: true
  });
});

//
// Tarefas --------------------------------------
//

gulp.task('compress', function () {
  return gulp.src('./storage/framework/views/*')
    .pipe(plumber())
    .pipe(debug())
    .pipe(htmlmin({
      collapseWhitespace: true,
      removeAttributeQuotes: true,
      removeComments: true,
      minifyJS: true
    }))
    .pipe(gulp.dest('./storage/framework/views/'));
});