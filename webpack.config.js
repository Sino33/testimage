var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');



module.exports = {

   entry: './src/js2.js',
   output: {
   path: path.resolve(__dirname, 'dist'),
   filename: 'app.bundle.js'
   },
   module: {

   loaders: [{
       test: /\.css$/,
       loader: "style-loader!css-loader"

       },
       { test: /\.(png|jpg|jpeg|gif|svg)$/,
       loader: 'file-loader' }
       ]
   }
};


Encore

   // the project directory where compiled assets will be stored
   .setOutputPath('public/build/')
   // the public path used by the web server to access the previous directory
   .setPublicPath('/build')
   .cleanupOutputBeforeBuild()
   .enableSourceMaps(!Encore.isProduction())
   // uncomment to create hashed filenames (e.g. app.abc123.css)
   .enableVersioning(Encore.isProduction())

   // uncomment to define the assets of the project
   .addEntry('js/app', './assets/js/app.js')
   .addStyleEntry('css/app', './assets/css/app.scss')


   // // uncomment if you use Sass/SCSS files
   .enableSassLoader()

   // uncomment for legacy applications that require $/jQuery as a global variable
   .autoProvidejQuery()

   .addPlugin(new CopyWebpackPlugin([
       // copies to {output}/static
       { from: './assets/static', to: 'static' }
   ]));
   
   
module.exports = Encore.getWebpackConfig();