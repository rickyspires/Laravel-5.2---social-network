/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var elixir = require('laravel-elixir');

var paths = {
    'pub_css': 'public/css',
    'pub_js': 'public/js',
    'res_css': 'resources/assets/css',
    'res_js': 'resources/assets/js',
    'bootstrap': 'bower_components/bootstrap/dist',
    'jquery': 'bower_components/jquery/dist'
}


elixir(function(mix) {

    mix.less('app.less', 'public/css/')
    .styles([
        paths.bootstrap + "/css/bootstrap.min.css",
        paths.res_css + "/ie10-viewport-bug-workaround.css",
        paths.pub_css + "/app.css"
    ],  paths.pub_css + "/all.css", "./");

    mix.scripts([
        paths.jquery + "/jquery.min.js",
        paths.bootstrap + "/js/bootstrap.min.js",
        //paths.res_js + "/ie-emulation-modes-warning.js",
        //paths.res_js + "/ie10-viewport-bug-workaround.js",
        //paths.res_js + "/ie8-responsive-file-warning.js",
        paths.res_js + "/site.js"
    ],  paths.pub_js + "/all.js", "./")
    .coffee('module.coffee');

    mix.copy(
        paths.bootstrap + '/fonts/**', 'public/build/fonts'
    );

    //version control & cache 
    mix.version(["css/all.css", "js/all.js"]);
});
	