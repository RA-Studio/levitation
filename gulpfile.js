const gulp = require('gulp');
const pug = require('gulp-pug');
const del = require('del');
const browserSync = require('browser-sync').create();
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const cache = require('gulp-cache');
const autoprefixer = require('gulp-autoprefixer');

// styles
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');

const paths = {
	root: './build',
	templates: {
		pages: 'src/templates/pages/*.pug',
		src: 'src/templates/**/*.pug',
		dest: 'build/assets/'
	},
	styles: {
		src: 'src/styles/**/*.*',
		dest: 'build/assets/styles/'
	},
	scripts: {
		src: 'src/scripts/**/*.*',
		dest: 'build/assets/scripts/'
	},
	images: {
		src: 'src/images/**/*.*',
		dest: 'build/assets/images/'
	},
	fonts: {
		src: 'src/fonts/**/*.*',
		dest: 'build/assets/fonts/'
	}
}

//pug
function templates() {
	return gulp.src(paths.templates.pages)
		.pipe(pug({ pretty: true }))
		.pipe(gulp.dest(paths.root));
}

//scss
function styles() {
	return gulp.src('./src/styles/app.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({ outputStyle: 'compressed' }))
		.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true })) // Создаем префиксы
		.pipe(sourcemaps.write())
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest(paths.styles.dest))
}

//scripts
function scripts() {
	return gulp.src(paths.scripts.src)
		.pipe(gulp.dest(paths.scripts.dest));
}

//fonts
function fonts() {
	return gulp.src(paths.fonts.src)
		.pipe(gulp.dest(paths.fonts.dest));
}

// картинки
function images() {
	return gulp.src(paths.images.src) // Берем все изображения из app
		.pipe(cache(imagemin({  // Сжимаем их с наилучшими настройками с учетом кеширования
			interlaced: true,
			progressive: true,
			svgoPlugins: [{ removeViewBox: false }],
			use: [pngquant()]
		})))
		.pipe(gulp.dest(paths.images.dest)); // Выгружаем на продакшен
}

// очистка
function clean() {
	return del(paths.root);
}

// следим за исходниками, папка src
function watch() {
	gulp.watch(paths.styles.src, styles);
	gulp.watch(paths.templates.src, templates);
	gulp.watch(paths.images.src, images);
	gulp.watch(paths.scripts.src, scripts);
}

// следим за build и релоадим браузер
function server() {
	browserSync.init({
		server: paths.root
	});
	browserSync.watch(paths.root + '/**/*.*', browserSync.reload)
}

exports.templates = templates;
exports.styles = styles;
exports.clean = clean;
exports.images = images;
exports.scripts = scripts;
exports.fonts = fonts;

// просто работаем
gulp.task('default', gulp.series(
	gulp.parallel(styles, templates, images, scripts, fonts),
	gulp.parallel(watch, server)
));

// контрольная сборка на продакшен
gulp.task('build', gulp.parallel(
	clean,
	gulp.parallel(styles, templates, images, scripts, fonts)
));