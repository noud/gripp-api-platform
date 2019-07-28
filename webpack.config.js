const Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('2fa', './assets/js/2fa.js')
    .addEntry('timeline', './assets/js/timeline.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning()

    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/static' },
        {from: './assets/images', to: '../images'}
    ]))
 
//    .enableLessLoader()
//    .enablePostCssLoader()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

const config = Encore.getWebpackConfig();

config.watchOptions = {
    poll: true,
};

config.module = {
    rules: [{
        test: /node_modules[\\\/]vis[\\\/].*\.js$/,
        loader: 'babel-loader',
        query: {
            cacheDirectory: true,
            presets: [ "babel-preset-env" ].map(require.resolve),
            plugins: [
                "transform-es3-property-literals", // #2452
                "transform-es3-member-expression-literals", // #2566
                "transform-runtime" // #2566
            ]
        }
    },
	{
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
    },
//	{
//        test: /\.(gif|png|jpe?g|svg)$/i,
//        use: [
//            'file-loader',
//            {
//                loader: 'image-webpack-loader',
//                options: {
//                    bypassOnDebug: true, // webpack@1.x
//                    disable: true, // webpack@2.x and newer
//                },
//            },
//        ],
//    }
    ]
};

module.exports = config;