const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = [
	{
		context: path.join(__dirname, 'sass'),
		entry: { style: './style.scss' },
		output: {
			path: path.join(__dirname, 'css'),
			filename: '[name].css'
		},
		module: {
			rules: [{
				test: /\.scss$/,
				exclude: /node_modules/,
				use: ExtractTextPlugin.extract({
					fallback: 'style-loader',
					use: [
						{
							loader: 'css-loader',
							options: {
								url: false
							}
						},
						'sass-loader'
					]
				})
			}]
		},
		devtool: 'inline-source-map',
		plugins: [
			new ExtractTextPlugin({
				filename: '[name].css'
			})
		]
	}
];
