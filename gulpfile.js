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
// Folders --------------------------------------
//

var nodeDir = './node_modules';
var fontDir = './resources/assets/fonts';
var imageDir = './resources/assets/images';
var jsDir = './resources/assets/js';
var sassDir = './resources/assets/sass';

//
// Elixir ---------------------------------------
//

const elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

elixir(function (mix) {
  // Fontes
  mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
    .copy('node_modules/font-awesome/fonts', 'public/build/fonts');

  // Imagens
  mix.copy('resources/assets/img', 'public/img')
    .copy('node_modules/jquery-ui/themes/base/images', 'public/img')
    .copy('node_modules/jquery-ui/themes/base/images', 'public/build/img')
    .copy('node_modules/fancybox/dist/img', 'public/img')
    .copy('node_modules/fancybox/dist/img', 'public/build/img')
    .copy('resources/assets/img', 'public/build/img');

  // Scripts
  mix.copy(nodeDir + '/html5shiv/dist/html5shiv.min.js', 'public/js');

  //
  // Primary
  //

  mix.sass([
    sassDir + '/primary/styles.scss'
  ], 'public/css/primary.css', __dirname);

  mix.scripts([
    nodeDir + '/jquery/dist/jquery.js',
    nodeDir + '/holderjs/holder.js',
    nodeDir + '/imagesloaded/imagesloaded.pkgd.min.js'
  ], 'public/js/primary.js', __dirname);

  //
  // CPanel
  //

  mix.sass([
    'resources/assets/sass/cpanel/cpanel.scss',
    'node_modules/fancybox/dist/scss/jquery.fancybox.scss',
    'node_modules/jquery-topalert/topalert.css',
    'node_modules/sweetalert2/dist/sweetalert2.css',
    'node_modules/jquery-ui/themes/base/core.css',
    'node_modules/jquery-ui/themes/base/datepicker.css',
    'node_modules/jquery-ui/themes/base/slider.css',
    'node_modules/jquery-ui/themes/base/theme.css',
    'node_modules/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.css',
    'node_modules/select2/dist/css/select2.css'
  ], 'public/css/cpanel.css', __dirname);

  mix.webpack([
    'resources/assets/js/cpanel/cpanel.js',
    'node_modules/jquery-formlink/jquery.formlink.js',
    'node_modules/jquery-topalert/jquery.topalert.js',
    'node_modules/fancybox/dist/js/jquery.fancybox.pack.js',
    'node_modules/select2/dist/js/select2.full.js',
    'node_modules/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.js',
    'node_modules/jquery-text-counter/textcounter.js',
    'node_modules/jquery-mask-plugin/dist/jquery.mask.js',
    'resources/assets/js/_common/jquery.uplab.js',
    'resources/assets/js/_common/jquery.slugger.js'
  ], 'public/js/cpanel.js', __dirname);

  //
  // Version
  //

  mix.version([

    // CPanel
    'public/js/cpanel.js',
    'public/css/cpanel.css',

    // Primary
    'public/js/primary.js',
    'public/css/primary.css'

  ]);

  //
  // browserSync
  //

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
      // removeAttributeQuotes: true,
      removeComments: true,
      minifyJS: true
    }))
    .pipe(gulp.dest('./storage/framework/views/'));
});