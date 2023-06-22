    const mix = require('laravel-mix');
    const lodash = require("lodash");
    const WebpackRTLPlugin = require('webpack-rtl-plugin');
    const folder = {
        src: "resources/", // source files
        dist: "public/", // build files
        dist_assets: "public/assets/" //build assets files
    };

    /*
     |--------------------------------------------------------------------------
     | Mix Asset Management
     |--------------------------------------------------------------------------
     |
     | Mix provides a clean, fluent API for defining some Webpack build steps
     | for your Laravel application. By default, we are compiling the Sass
     | file for the application as well as bundling up all the JS files.
     |
     */

     mix.copyDirectory("resources/plugins/hopscotch/img", folder.dist_assets + "/plugins/hopscotch/img");

    // copy all fonts
    var out = folder.dist_assets + "fonts";
    mix.copyDirectory(folder.src + "fonts", out);

    // copy all images
    var out = folder.dist_assets + "images";
    mix.copyDirectory(folder.src + "images", out);

    // // copy all js
    // var out = folder.dist_assets + "js";
    // mix.copyDirectory(folder.src + "js", out);

    mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
    mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/icons.css");
    mix.sass('resources/scss/app.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/app.css");


    mix.webpackConfig({
        plugins: [
            new WebpackRTLPlugin()
        ],
        stats: {
            children: true,
        },
    });


    //copying demo pages related assets
    var app_pages_assets = {
        js: [
            folder.src + "pages/animation.init.js",
            folder.src + "pages/clipboard.init.js",
            folder.src + "pages/dragula.init.js",
            folder.src + "pages/ui-slider.js",
            folder.src + "pages/sweet-alert.init.js",
            folder.src + "pages/toast.init.js",
            folder.src + "pages/analytics-customers.init.js",
            folder.src + "pages/analytics-report.init.js",
            folder.src + "pages/calendar.init.js",
            // folder.src + "pages/form-editor.init.js",
            folder.src + "pages/apexcharts.init.js",
            folder.src + "pages/chartjs.init.js",
            folder.src + "pages/justgage.init.js",
            // folder.src + "pages/jquery.morris.init.js",
            folder.src + "pages/toast-ui.init.js",
            folder.src + "pages/crypto-exchange.init.js",
            folder.src + "pages/crypto-index.init.js",
            folder.src + "pages/crypto-wallet.init.js",
            folder.src + "pages/ecommerce-index.init.js",
            folder.src + "pages/splide.init.js",
            folder.src + "pages/forms-advanced.js",
            folder.src + "pages/form-editor.init.js",
            folder.src + "pages/file-upload.init.js",
            folder.src + "pages/form-validation.js",
            folder.src + "pages/form-wizard.js",
            folder.src + "pages/projects-index.init.js",
            folder.src + "pages/analytics-index.init.js",
            folder.src + "pages/gmaps.init.js",
            folder.src + "pages/leaflet-map.init.js",
            folder.src + "pages/vectormap.init.js",
            folder.src + "pages/gallery.init.js",
            folder.src + "pages/tour.init.js",
            folder.src + "pages/tree.init.js",
            folder.src + "pages/projects-task.init.js",
            folder.src + "pages/datatable.init.js",
            folder.src + "pages/editable.init.js",
        ]
    };


    var out = folder.dist_assets + "";
    lodash(app_pages_assets).forEach(function (assets, type) {
        for (let i = 0; i < assets.length; ++i) {
            mix.js(assets[i], out + "pages");
        };
    });

    mix.combine('resources/js/app.js', folder.dist_assets + "js/app.js");
    mix.combine('resources/js/simplebar.min.js', folder.dist_assets + "js/app.min.js");
    mix.combine('resources/plugins/animate/animate.min.css', folder.dist_assets + "plugins/animate/animate.min.css");
    mix.combine('resources/plugins/animate/magic.min.css', folder.dist_assets + "plugins/animate/magic.min.css");
    mix.combine('resources/plugins/clipboard/clipboard.min.js', folder.dist_assets + "plugins/clipboard/clipboard.min.js");
    mix.combine('resources/plugins/dragula/dragula.min.css', folder.dist_assets + "plugins/dragula/dragula.min.css");
    mix.combine('resources/plugins/dragula/dragula.min.js', folder.dist_assets + "plugins/dragula/dragula.min.js");
    mix.combine('resources/plugins/prettify/prettify.css', folder.dist_assets + "plugins/prettify/prettify.css");
    mix.combine('resources/plugins/prettify/run_prettify.js', folder.dist_assets + "plugins/prettify/run_prettify.js");
    mix.combine('resources/plugins/ui-slider/nouislider.css', folder.dist_assets + "plugins/ui-slider/nouislider.css");
    mix.combine('resources/plugins/ui-slider/nouislider.min.js', folder.dist_assets + "plugins/ui-slider/nouislider.min.js");
    mix.combine('resources/plugins/ui-slider/wNumb.js', folder.dist_assets + "plugins/ui-slider/wNumb.js");
    mix.combine('resources/plugins/rating/starability-all.css', folder.dist_assets + "plugins/rating/starability-all.css");
    mix.combine('resources/plugins/sweet-alert2/sweetalert2.min.css', folder.dist_assets + "plugins/sweet-alert2/sweetalert2.min.css");
    mix.combine('resources/plugins/sweet-alert2/sweetalert2.min.js', folder.dist_assets + "plugins/sweet-alert2/sweetalert2.min.js");

    mix.combine('resources/plugins/datatables/datatable.css', folder.dist_assets + "plugins/datatables/datatable.css");
    mix.combine('resources/plugins/datatables/simple-datatables.js', folder.dist_assets + "plugins/datatables/simple-datatables.js");
    mix.combine('resources/plugins/apexcharts/apexcharts.min.js', folder.dist_assets + "plugins/apexcharts/apexcharts.min.js");
    mix.combine('resources/plugins/apexcharts/irregular-data-series.js', folder.dist_assets + "plugins/apexcharts/irregular-data-series.js");
    mix.combine('resources/plugins/apexcharts/ohlc.js', folder.dist_assets + "plugins/apexcharts/ohlc.js");
    mix.combine('resources/plugins/fullcalendar/main.css', folder.dist_assets + "plugins/fullcalendar/main.css");
    mix.combine('resources/plugins/fullcalendar/main.min.js', folder.dist_assets + "plugins/fullcalendar/main.min.js");
    mix.combine('resources/plugins/tinymce/tinymce.min.js', folder.dist_assets + "plugins/tinymce/tinymce.min.js");
    mix.combine('resources/plugins/chartjs/chart.js', folder.dist_assets + "plugins/chartjs/chart.js");
    mix.combine('resources/plugins/justgage/raphael.min.js', folder.dist_assets + "plugins/justgage/raphael.min.js");
    mix.combine('resources/plugins/justgage/justgage.js', folder.dist_assets + "plugins/justgage/justgage.js");
    mix.combine('resources/plugins/toast-ui/tui-chart.min.css', folder.dist_assets + "plugins/toast-ui/tui-chart.min.css");
    mix.combine('resources/plugins/toast-ui/tui-chart-all.min.js', folder.dist_assets + "plugins/toast-ui/tui-chart-all.min.js");
    mix.combine('resources/plugins/toast-ui/usa.min.js', folder.dist_assets + "plugins/toast-ui/usa.min.js");

    mix.combine('resources/plugins/splide/splide.min.css', folder.dist_assets + "plugins/splide/splide.min.css");
    mix.combine('resources/plugins/splide/splide.min.js', folder.dist_assets + "plugins/splide/splide.min.js");
    mix.combine('resources/plugins/select/selectr.min.css', folder.dist_assets + "plugins/select/selectr.min.css");
    mix.combine('resources/plugins/huebee/huebee.min.css', folder.dist_assets + "plugins/huebee/huebee.min.css");
    mix.combine('resources/plugins/datepicker/datepicker.min.css', folder.dist_assets + "plugins/datepicker/datepicker.min.css");
    mix.combine('resources/plugins/select/selectr.min.js', folder.dist_assets + "plugins/select/selectr.min.js");
    mix.combine('resources/plugins/huebee/huebee.pkgd.min.js', folder.dist_assets + "plugins/huebee/huebee.pkgd.min.js");
    mix.combine('resources/plugins/datepicker/datepicker-full.min.js', folder.dist_assets + "plugins/datepicker/datepicker-full.min.js");
    mix.combine('resources/plugins/moment/moment.js', folder.dist_assets + "plugins/moment/moment.js");
    mix.combine('resources/plugins/imask/imask.js', folder.dist_assets + "plugins/imask/imask.js");
    mix.combine('resources/plugins/tinymce/tinymce.min.js', folder.dist_assets + "plugins/tinymce/tinymce.min.js");
    mix.combine('resources/plugins/cropper/css/cropper.css', folder.dist_assets + "plugins/cropper/css/cropper.css");
    mix.combine('resources/plugins/cropper/css/main.css', folder.dist_assets + "plugins//cropper/css/main.css");
    mix.combine('resources/plugins/cropper/js/cropper.js', folder.dist_assets + "plugins/cropper/js/cropper.js");
    mix.combine('resources/plugins/cropper/js/main.js', folder.dist_assets + "plugins/cropper/js/main.js");
    mix.combine('resources/plugins/uppy/uppy.min.css', folder.dist_assets + "plugins/uppy/uppy.min.css");
    mix.combine('resources/plugins/uppy/uppy.min.js', folder.dist_assets + "plugins/uppy/uppy.min.js");
    mix.combine('resources/plugins/lightpicker/litepicker.js', folder.dist_assets + "plugins/lightpicker/litepicker.js");
    mix.combine('resources/plugins/gmaps/gmaps.js', folder.dist_assets + "plugins/gmaps/gmaps.js");
    mix.combine('resources/plugins/leaflet/leaflet.css', folder.dist_assets + "plugins/leaflet/leaflet.css");
    mix.combine('resources/plugins/leaflet/leaflet.js', folder.dist_assets + "plugins/leaflet/leaflet.js");
    mix.combine('resources/plugins/jmap/jsvectormap.css', folder.dist_assets + "plugins/jmap/jsvectormap.css");
    mix.combine('resources/plugins/jmap/jsvectormap.min.js', folder.dist_assets + "plugins/jmap/jsvectormap.min.js");
    mix.combine('resources/plugins/jmap/world.js', folder.dist_assets + "plugins/jmap/world.js");
    mix.combine('resources/plugins/jmap/russia.js', folder.dist_assets + "plugins/jmap/russia.js");
    mix.combine('resources/plugins/tobii/tobii.min.css', folder.dist_assets + "plugins/tobii/tobii.min.css");
    mix.combine('resources/plugins/tobii/tobii.min.js', folder.dist_assets + "plugins/tobii/tobii.min.js");
    mix.combine('resources/plugins/shuffle/shuffle.min.js', folder.dist_assets + "plugins/shuffle/shuffle.min.js");
    mix.combine('resources/plugins/hopscotch/hopscotch.css', folder.dist_assets + "plugins/hopscotch/hopscotch.css");
    mix.combine('resources/plugins/hopscotch/hopscotch.js', folder.dist_assets + "plugins/hopscotch/hopscotch.js");
    mix.combine('resources/plugins/tree/listree.min.css', folder.dist_assets + "plugins/tree/listree.min.css");
    mix.combine('resources/plugins/tree/listree.umd.min.js', folder.dist_assets + "plugins/tree/listree.umd.min.js");
    mix.combine('resources/plugins/tabulator/bootstrap/tabulator_bootstrap4.css', folder.dist_assets + "plugins/tabulator/bootstrap/tabulator_bootstrap4.css");
    mix.combine('resources/plugins/tabulator/tabulator.min.js', folder.dist_assets + "plugins/tabulator/tabulator.min.js");
    mix.combine('resources/plugins/prettify/prettify.css', folder.dist_assets + "plugins/prettify/prettify.css");
    mix.combine('resources/plugins/prettify/run_prettify.js', folder.dist_assets + "plugins/prettify/run_prettify.js");