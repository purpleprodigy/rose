//process.env.DISABLE_NOTIFIER = true; // Uncomment to disable all Gulp notifications.

/**
 * Rose.
 *
 * This file adds gulp tasks to the Rose theme.
 *
 * @author Seo themes
 */

// Require our dependencies.
var args         = require('yargs').argv,
	autoprefixer = require('autoprefixer'),
	browsersync  = require('browser-sync'),
	bump         = require('gulp-bump'),
	changecase   = require('change-case'),
	del          = require('del'),
	mqpacker     = require('css-mqpacker'),
	fs           = require('fs'),
	gulp         = require('gulp'),
	beautify     = require('gulp-cssbeautify'),
	cache        = require('gulp-cached'),
	cleancss     = require('gulp-clean-css'),
	csscomb      = require('gulp-csscomb'),
	cssnano      = require('gulp-cssnano'),
	filter       = require('gulp-filter'),
	imagemin     = require('gulp-imagemin'),
	notify       = require('gulp-notify'),
	pixrem       = require('gulp-pixrem'),
	plumber      = require('gulp-plumber'),
	postcss      = require('gulp-postcss'),
	rename       = require('gulp-rename'),
	replace      = require('gulp-replace'),
	sass         = require('gulp-sass'),
	sort         = require('gulp-sort'),
	sourcemaps   = require('gulp-sourcemaps'),
	uglify       = require('gulp-uglify'),
	wpPot        = require('gulp-wp-pot'),
	zip          = require('gulp-zip'),
	focus        = require('postcss-focus');

// Set assets paths.
var paths = {
	all:     ['./**/*', '!./node_modules/', '!./node_modules/**', '!./screenshot.png', '!./assets/images/**'],
	concat:  ['assets/scripts/menus.js', 'assets/scripts/superfish.js'],
	images:  ['assets/images/*', '!assets/images/*.svg'],
	php:     ['./*.php', './**/*.php', './**/**/*.php'],
	scripts: ['assets/scripts/*.js', '!assets/scripts/min/'],
	styles:  ['assets/styles/*.scss', '!assets/styles/min/']
};

/**
 * Compile WooCommerce styles.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
gulp.task('woocommerce', function () {

	/**
	 * Process WooCommerce styles.
	 */
	gulp.src('assets/styles/woocommerce.scss')

		// Notify on error
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Source maps init
		.pipe(sourcemaps.init())

		// Process sass
		.pipe(sass({
			outputStyle: 'expanded'
		}))

		// Pixel fallbacks for rem units.
		.pipe(pixrem())

		// Parse with PostCSS plugins.
		.pipe(postcss([
			autoprefixer({
				browsers: [
					'last 2 versions',
					'ie 10'
				]
			}),
			mqpacker({
				sort: true
			}),
			focus(),
		]))

		// Format non-minified stylesheet.
		.pipe(csscomb())

		// Write source map.
		.pipe(sourcemaps.write('./'))

		// Output non minified css to theme directory.
		.pipe(gulp.dest('./'))

		// Inject changes via browsersync.
		.pipe(browsersync.reload({
			stream: true
		}))

		// Filtering stream to only css files.
		.pipe(filter('**/*.css'))

		// Notify on successful compile (uncomment for notifications).
		.pipe(notify("Compiled: <%= file.relative %>"));

});

/**
 * Compile Sass.
 *
 * https://www.npmjs.com/package/gulp-sass
 */
gulp.task('styles', ['woocommerce'], function () {

	gulp.src('assets/styles/style.scss')

		// Notify on error
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Source maps init
		.pipe(sourcemaps.init())

		// Process sass
		.pipe(sass({
			outputStyle: 'expanded'
		}))

		// Pixel fallbacks for rem units.
		.pipe(pixrem())

		// Parse with PostCSS plugins.
		.pipe(postcss([
			autoprefixer({
				browsers: 'last 2 versions'
			}),
			mqpacker({
				sort: true
			}),
			focus(),
		]))

		// Format non-minified stylesheet.
		.pipe(csscomb())

		// Write source map.
		.pipe(sourcemaps.write('./'))

		// Output non minified css to theme directory.
		.pipe(gulp.dest('./'))

		// Inject changes via browsersync.
		.pipe(browsersync.reload({
			stream: true
		}))

		// Filtering stream to only css files.
		.pipe(filter('**/*.css'))

		// Notify on successful compile (uncomment for notifications).
		.pipe(notify("Compiled: <%= file.relative %>"));

});

/**
 * Minify javascript files.
 *
 * https://www.npmjs.com/package/gulp-uglify
 */
gulp.task('scripts', function () {

	gulp.src(paths.scripts)

		// Notify on error.
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Cache files to avoid processing files that haven't changed.
		.pipe(cache('scripts'))

		// Add .min suffix.
		.pipe(rename({
			suffix: '.min'
		}))

		// Minify.
		.pipe(uglify())

		// Output the processed js to this directory.
		.pipe(gulp.dest('assets/scripts/min'))

		// Inject changes via browsersync.
		.pipe(browsersync.reload({
			stream: true
		}))

		// Notify on successful compile.
		.pipe(notify("Minified: <%= file.relative %>"));

});

/**
 * Optimize images.
 *
 * https://www.npmjs.com/package/gulp-imagemin
 */
gulp.task('images', function () {

	return gulp.src(paths.images)

		// Notify on error.
		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		// Cache files to avoid processing files that haven't changed.
		.pipe(cache('images'))

		// Optimize images.
		.pipe(imagemin({
			progressive: true
		}))

		// Output the optimized images to this directory.
		.pipe(gulp.dest('assets/images'))

		// Inject changes via browsersync.
		.pipe(browsersync.reload({
			stream: true
		}))

		// Notify on successful compile.
		.pipe(notify("Optimized: <%= file.relative %>"));

});

/**
 * Scan the theme and create a POT file.
 *
 * https://www.npmjs.com/package/gulp-wp-pot
 */
gulp.task('translate', function () {

	return gulp.src(paths.php)

		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))

		.pipe(sort())

		.pipe(wpPot({
			domain: 'rose',
			destFile: 'rose.pot',
			package: 'Rose',
			bugReport: 'https://seothemes.com/support',
			lastTranslator: 'Lee Anthony <seothemeswp@gmail.com>',
			team: 'SEO Themes <seothemeswp@gmail.com>'
		}))

		.pipe(gulp.dest('./languages/'));

});

/**
 * Package theme.
 *
 * https://www.npmjs.com/package/gulp-zip
 */
gulp.task('zip', function () {

	gulp.src(['./**/*', '!./node_modules/', '!./node_modules/**', '!./aws.json'])
		.pipe(zip(__dirname.split("/").pop() + '.zip'))
		.pipe(gulp.dest('../'));

});

/**
 * Process tasks and reload browsers on file changes.
 *
 * https://www.npmjs.com/package/browser-sync
 *
 * If you are not using a self-signed certificate, use the below config:
 *
 * browsersync( {
 *	    proxy: 'rose.dev',
 *	    notify: false,
 *	    open: false,
 * } );
 */
gulp.task('watch', function () {

	// HTTPS (optional).
	browsersync({
		proxy: 'https://corporate.test',
		port: 8000,
		notify: false,
		open: false,
		https: {
			"key": "/Users/seothemes/.valet/Certificates/corporate.test.key",
			"cert": "/Users/seothemes/.valet/Certificates/corporate.test.crt"
		}
	});

	// Run tasks when files change.
	gulp.watch(paths.styles, ['styles']);
	gulp.watch(paths.scripts, ['scripts']);
	gulp.watch(paths.images, ['images']);
	gulp.watch(paths.php).on('change', browsersync.reload);

});

/**
 * Rename theme.
 *
 * https://www.npmjs.com/package/change-case
 * https://www.npmjs.com/package/yargs
 */
gulp.task('rename', function () {

	var old_name = 'Rose',
		old_domain = 'rose',
		old_prefix = 'rose_';

	var new_name = changecase.titleCase(args.to),
		new_domain = changecase.paramCase(args.to),
		new_prefix = changecase.snakeCase(args.to) + '_';

	del(['./languages/' + old_domain + '.pot']);

	gulp.src(paths.all)
		.pipe(replace(old_name, new_name))
		.pipe(replace(old_domain, new_domain))
		.pipe(replace(old_prefix, new_prefix))
		.pipe(gulp.dest('./'));

});

/**
 * Bump version.
 *
 * https://www.npmjs.com/package/gulp-bump
 */
gulp.task('bump', function () {

	if (args.major) {
		var kind = 'major';
	}

	if (args.minor) {
		var kind = 'minor';
	}

	if (args.patch) {
		var kind = 'patch';
	}

	gulp.src(['./package.json', './style.css'])
		.pipe(bump({
			type: kind,
			version: args.to
		}))
		.pipe(gulp.dest('./'));

	gulp.src(['./functions.php'])
		.pipe(bump({
			key: "'CHILD_THEME_VERSION',",
			type: kind,
			version: args.to
		}))
		.pipe(gulp.dest('./'));

	gulp.src('./assets/styles/style.scss')
		.pipe(bump({
			type: kind,
			version: args.to
		}))
		.pipe(gulp.dest('./assets/styles/'));

});

/**
 * Create default task.
 */
gulp.task('default', ['watch'], function () {

	gulp.start('styles', 'scripts', 'images');

});

