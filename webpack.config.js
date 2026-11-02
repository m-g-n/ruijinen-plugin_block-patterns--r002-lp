const path = require("path");
const glob = require("glob");

// [出力先（dist/js からの相対）, 入力元] の配列を作る
const collectEntries = (srcDir, distDir) =>
	glob
		.sync("**/*.js", {
			ignore: "**/_*.js",
			cwd: srcDir,
		})
		.map((key) => [path.join(distDir, key), path.resolve(srcDir, key)]);

const entryObj = Object.fromEntries([
	...collectEntries("./patterns", "patterns"), // パターン固有のスクリプト
	...collectEntries("./src/js", "."), // エディター用などの共通スクリプト
]);

module.exports = {
	mode: "production",
	entry: entryObj,
	output: {
		path: path.join(__dirname, "dist/js"),
		filename: "[name]",
	},
};
