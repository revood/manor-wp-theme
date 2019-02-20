const gulp       = require( 'gulp' );
const livereload = require( 'gulp-livereload' );
const sourcemaps = require( 'gulp-sourcemaps' );
const sass       = require( 'gulp-sass' );
const postcss    = require( 'gulp-postcss' );

gulp.task( 'styles', () =>
	gulp.src( 'sass/*.scss' )
	.pipe( sourcemaps.init() )
	.pipe( sass({
		outputStyle: 'expanded',
		precision: 5,
	}).on( 'error', sass.logError ) )
	.pipe( postcss([
		require( 'postcss-import' )(),
		require( 'autoprefixer' )(),
		require( 'css-mqpacker' )({ sort: true }),
	]) )
	.pipe( sourcemaps.write( '' ) )
	.pipe( gulp.dest( '.' ) )
	.pipe( livereload() )
);

gulp.task( 'watch', () => {
	livereload.listen();
	gulp.watch( 'sass/**/*.scss', [ 'styles' ]);
});

gulp.task( 'default', [ 'styles' ]);
