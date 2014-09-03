var gulp = require('gulp');
	  minifyCSS = require('gulp-minify-css');
	  concat = require ('gulp-concat');


// For compressing js files
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');

// CSS
var sass = require('gulp-sass');


gulp.task('default', function() {

  // place code for your default task here
  	gulp.start('watch');

});


// Compile and Minify CSS
gulp.task('minify-css', function() {
	return gulp.src(['public/dev/scss/*.css'])
	           .pipe( minifyCSS() )
	           .pipe( gulp.dest('public/assets/css') );
});	

// Compile and Minify JS
gulp.task('minify-js', function() {
  gulp.src('public/dev/jquery/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('public/assets/js'))
});


gulp.task('compile-chunks-minify-js', function () {
	gulp.src('public/dev/jquery-dev2/*.js')
	    .pipe( concat('sub-scripts.js') )
	    .pipe( uglify() )
	    .pipe( gulp.dest('public/assets/js') );
});


// Compile Our Sass
gulp.task('sass', function() {
     gulp.src('public/dev/scss1/*.scss')
        .pipe( sass() )
        .pipe( minifyCSS() )
        .pipe(gulp.dest('public/assets/css'));
});



gulp.task('watch', function () {

    watch({glob: 'public/dev/scss1/*.scss'}, function(files) {
      gulp.start('sass');
    });
  	
  	// Watch for JS file for changes then minify it
    watch({glob: 'public/dev/jquery/*.js'}, function (files) { // watch any changes on coffee files
        gulp.start('minify-js'); // run the compile task
    });
  	
  	// Watch for JS file for changes then minify it
    watch({glob: 'public/dev/jquery-dev2/*.js'}, function (files) { // watch any changes on coffee files
        gulp.start('compile-chunks-minify-js'); // run the compile task
    });


    // Watch for CSS files for changes then minify it
    watch({glob: 'public/dev/css/*.css'}, function(files) {
    	gulp.start('minify-css')
    });


     
});