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

elixir(function(mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
       .copy('node_modules/font-awesome/fonts', 'public/build/fonts');

    mix.sass([
            'resources/assets/sass/cpanel.scss',
            'node_modules/sweetalert2/dist/sweetalert2.css'
        ], 'public/css/cpanel.css', __dirname);

    mix.webpack([
        'resources/assets/js/cpanel.js',
        'node_modules/jquery-formlink/jquery.formlink.js'
        ], 'public/js/cpanel.js', __dirname);

    mix.version([
        'public/js/cpanel.js',
        'public/css/cpanel.css'
    ]);

    mix.browserSync({
        proxy: 'centraljogos.dev',
        open: true,
        logConnections:  true,
        reloadOnRestart: true,
        notify: true
    });
});

//
// Tarefas --------------------------------------
//

gulp.task('compress', function() {
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