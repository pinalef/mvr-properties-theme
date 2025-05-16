const { src, dest, watch, series } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const browserSync = require("browser-sync").create();

// Paths
const scssPath = "../understrap-parent/src/sass/**/*.sass";
const cssDest = "./css";

function compileSass() {
	return src(scssPath)
		.pipe(sass({ outputStyle: "expanded" }).on("error", sass.logError))
		.pipe(postcss([autoprefixer()]))
		.pipe(dest(cssDest))
		.pipe(browserSync.stream());
}

function browserSyncInit(done) {
	browserSync.init({
		proxy: "mvrpropiedades.test",
		notify: false,
		open: false,
	});
	done();
}

function watchFiles() {
	watch(scssPath, compileSass);
	watch(["**/*.php", "./assets/js/**/*.js"]).on("change", browserSync.reload);
}

exports.default = series(compileSass, browserSyncInit, watchFiles);
