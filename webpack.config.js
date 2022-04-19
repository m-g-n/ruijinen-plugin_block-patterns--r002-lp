const path = require("path");
const glob = require("glob");

const srcDir = "./patterns";
const entries = glob
  .sync("**/*.js", {
    ignore: "**/_*.js",
    cwd: srcDir,
  })
  .map(function (key) {
    // [ '**/*.js' , './src/**/*.js' ]という形式の配列になる
    return [key, path.resolve(srcDir, key)];
  });

// 配列→{key:value}の連想配列へ変換
const entryObj = Object.fromEntries(entries);

module.exports = {
  entry: entryObj,
  output: {
    path: path.join(__dirname, "dist"),
    filename: "[name]",
  },
};
