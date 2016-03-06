var gulp = require('gulp');
var elixir = require('laravel-elixir');

gulp.task("copyfiles", function () {
	gulp.src("vendor/bower_download/jquery/dist/jquery.min.js")
		.pipe(gulp.dest("resources/assets/vendor/js/"));
	gulp.src("node_modules/foundation-sites/dist/foundation.min.js")
		.pipe(gulp.dest("resources/assets/vendor/js/"));
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

 elixir(function(mix) {
 	mix.scripts([
 		'js/jquery.min.js',
 		'js/foundation.min.js',
 		],
 		'public/assets/js/site.js',
 		'resources/assets/vendor'
 	);

     mix.sass('app.scss', 'public/assets/css', { includePaths: ['node_modules/foundation-sites/scss/']})
     	.browserSync({ proxy: 'makersvault.dev'});
 });
