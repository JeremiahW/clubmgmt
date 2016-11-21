var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');

var ExtractTextPlugin = require("extract-text-webpack-plugin");


var plugins = [];
var loaders = [
    { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" },
    { test: /\.css$/, loader: ExtractTextPlugin.extract("style-loader", "css-loader") },
    {test: /\.(eot|svg|ttf|woff|woff2)$/, loader: 'file?name=public/fonts/[name].[ext]'},
    {test: /\.(png|jpg)$/, loader: 'url-loader?limit=8192'},
    {
        test: /\.jsx?$/,         // Match both .js and .jsx files
        exclude: /node_modules/,
        loader: "babel",
        query:
        {
            presets:['react', "es2015"]
        }
    }
    // { test: /\.css$/, loader: "style-loader!css-loader" }
];


plugins.push(new ExtractTextPlugin("css/style.css"));
plugins.push(new webpack.ProvidePlugin({"$":"jquery"}));

plugins.push(
    new HtmlWebpackPlugin({
        template:"./index.html",
        filename:"html/index.html",
        inject:"body",
        hash:true,
        cache:true,
        showErrors:true,
        chunks:["js/index"]
    })
);

module.exports={
  entry:{
    "js/index":"./src/js/index.js"
  },
    output:{
        path:"./build",
        filename:"[name].js"
    },
    module:{
        loaders:loaders
    },
    plugins: plugins,
    externals:{

    }
};