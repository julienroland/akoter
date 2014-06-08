var 

gulp = require('gulp'),

autoprefixer = require('gulp-autoprefixer'),

notify = require('gulp-notify'),

sass = require('gulp-ruby-sass'),

compass = require('gulp-compass'),

minifyCSS = require('gulp-minify-css'),

uglify = require('gulp-uglify'),

changed = require('gulp-changed'),

livereload = require('gulp-livereload'),

concat = require('gulp-concat'),

concatCss = require('gulp-concat-css'),

htmlhint = require("gulp-htmlhint"),

psi = require('psi'),

imagemin = require('gulp-imagemin'),

pngcrush = require('imagemin-pngcrush'),

webp = require('gulp-webp')

;

gulp.task('css', function() {
	return gulp.src('sass/*.scss')
	.pipe(changed('css'))
	.pipe(compass({
		config_file: 'config.rb',
		css: 'css',
		sass: 'sass',
		comments: false,
		onError: function(err) {
			return notify().write(err);
		}
	}))
	.pipe(autoprefixer("last 15 version", "ie 8"))
	.pipe(minifyCSS())
	.pipe(gulp.dest('css'))
	.pipe(notify({ message: 'SASS bien compilé maître Julien !' }))
	.pipe(livereload());
});

gulp.task('psi', function (cb) {
	psi({
        nokey: 'true', // or use key: ‘YOUR_API_KEY’
        url: 'http://akoter.julien-roland.be',
        strategy: 'mobile',
    }, cb);
});

gulp.task('html', function(){

	gulp.src("./src/*.html")
	.pipe(htmlhint())
	.pipe(htmlhint.reporter());

});

gulp.task('js', function() {
	gulp.src('js/*.js')
	.pipe(changed('js/min'))
	.pipe(uglify())
	.pipe(gulp.dest('js/min'))
	.pipe(notify({ message: 'JS bien compilé maître Julien !' }))
	.pipe(livereload());
});


gulp.task('default' , function() {

	var server = livereload();

	gulp.watch('public/**').on('change', function(file) {
		server.changed(file.path);
	});
	
	gulp.run('css');
	gulp.run('js');

	gulp.watch('sass/**/*.scss', function() {
		gulp.run('css');
	});

	gulp.watch('js/**/*.js', function() {
		gulp.run('js');
	});

	/*return gulp.src('img/*')
	.pipe(imagemin({
		progressive: true,
		svgoPlugins: [{removeViewBox: false}],
		use: [pngcrush()]
	}))
	.pipe(gulp.dest('img/'));

	return gulp.src('img/*')
        .pipe(webp())
        .pipe(gulp.dest('img/webp'));*/
});