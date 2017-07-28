let mix = require('laravel-mix');

// Define package alias and its file path
// Helps remove duplicate imports and build is way faster
mix.webpackConfig({
    resolve: {
    	extensions: ['.js'],
        alias: {
        	axios: 'axios/dist/axios.js',
        	jquery: 'jquery/dist/jquery.js',
        	lodash: 'lodash/lodash.js',
        	moment: 'moment/moment.js',
        	semantic: 'semantic-ui/dist/semantic.min.js',
          nprogress: 'nprogress/nprogress.js'
    	}
    }
});

// Copy fonts and images to public
mix.copy('node_modules/semantic-ui/dist/themes/default/assets/fonts/**/*', 'public/assets/fonts')
   .copy('node_modules/semantic-ui/dist/themes/default/assets/images/**/*', 'public/assets/images')
   .copy('resources/assets/fonts/**/*', 'public/assets/fonts')
   .copy('resources/assets/images/**/*', 'public/assets/images');

// Build vendor css
mix.sass('resources/assets/sass/vendor.sass', 'public/assets/css')
   .version();

// Build application css
mix.sass('resources/assets/sass/app.sass', 'public/assets/css')
   .version();

// Build manifest, vendor and app js
// Prevents Mix's automatic configuring of jQuery, so that we can set it up ourselves later
// 1. https://github.com/JeffreyWay/laravel-mix/issues/229#issuecomment-276332984
// 2. https://github.com/JeffreyWay/laravel-mix/blob/master/docs/autoloading.md
mix.js('resources/assets/js/app.js', 'public/assets/js')
   .extract(['jquery', 'semantic', 'moment', 'lodash', 'vue', 'axios', 'nprogress'])
   .autoload({jquery: ['$', 'window.jQuery', 'jQuery', 'jquery'],})
   .version();
