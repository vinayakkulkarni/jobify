var gulp = require('gulp');

var semantic = {
  watch: require('./node_modules/semantic-ui/tasks/watch'),
  build: require('./node_modules/semantic-ui/tasks/build')
};

gulp.task('semantic-copy-config', function () {
  gulp.src('theme.config').pipe(gulp.dest('node_modules/semantic-ui/src/', {overwrite: true}));
});

gulp.task('semantic-build', ['semantic-copy-config'], semantic.build);
