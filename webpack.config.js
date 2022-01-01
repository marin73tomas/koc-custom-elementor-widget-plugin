const path = require("path");

module.exports = {
  // 1
  entry: path.resolve(__dirname, "./src/main.js"),
  // 2
  output: {
    path: path.resolve(__dirname, "./build/"),
    filename: "bundle.min.js",
  },
  // 3
  module: {
    rules: [
      {
        test: /\.(js)$/,
        exclude: /node_modules/,
        use: ["babel-loader"],
      },
    ],
  },
  resolve: {
    extensions: ["*", ".js"],
  },
};
