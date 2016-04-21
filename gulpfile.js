var gulp = require('gulp'),
	gulpLoadPlugins = require('gulp-load-plugins'),
    plugins = gulpLoadPlugins();

var mainBowerFiles = require('main-bower-files');

gulp.task('copyfonts', function(){
	gulp.src('bower_components/bootstrap/fonts/*.*')
		.pipe(gulp.dest('style/fonts/'));
})

gulp.task('compilecss', function () {
	var lessfilter = plugins.filter('*.less');
	gulp.src(mainBowerFiles())
		.pipe(lessfilter)
		.pipe(plugins.less())
		.pipe(plugins.concat('style.css'))
		.pipe(gulp.dest('style/css/'));
});

gulp.task('compilejs', function () {
	var jsfilter = plugins.filter('*.js');
	gulp.src(mainBowerFiles())
		.pipe(jsfilter)
		.pipe(plugins.uglify().on('error', errorHandler))		
		.pipe(plugins.concat('main.js').on('error', errorHandler))
		.pipe(gulp.dest('style/scripts/').on('error', errorHandler));
});

function errorHandler(error) {
	console.log(error.toString());
	this.emit('end');
}

gulp.task('default', ['compilecss', 'compilejs', 'copyfonts']);