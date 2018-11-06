const config = require("./tailwind.master.js");

config.fonts["sans"].unshift("Roboto");
config.fonts["serif"].unshift("Playfair Display");

config.textSizes["6xl"] = "4rem";
config.textSizes["7xl"] = "5rem";

config.height["40"] = "10rem";
config.height["80"] = "20rem";
config.height["96"] = "24rem";
config.height["112"] = "28rem";

config.padding["64"] = "16rem";
config.margin["64"] = "16rem";
config.negativeMargin["64"] = "16rem";

module.exports = config;
