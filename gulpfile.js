const gulp = require('gulp');
const sass = require('gulp-dart-sass');
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const csso = require('gulp-csso');

// Função para compilar o SASS
function compilaSass() {
    return gulp
        .src('css/sass/style.scss') // compila só o principal
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(csso())
        .pipe(concat('style.css'))
        .pipe(gulp.dest('css/'));
}
exports.compilaSass = compilaSass;

// Watch para todos os arquivos .scss (mas compila só o style.scss)
function watch() {
    gulp.watch('css/sass/**/*.scss', compilaSass);
}
exports.watch = watch;

// Tarefa padrão
exports.default = gulp.series(gulp.parallel(watch), compilaSass);
