MU Starter Plugin
===
Use this repository to create new WordPress plugins for use on the Marshall University WordPress multisite. This repo includes everything needed to get up and running using the Marsha WordPress theme styles.

# Getting Started
1. Clone the repo
2. Run `npm install` to install the required npm dependencies
3. Run `composer install` to install the required composer dependencies
4. In development you can run the `npm run watch` command and it will continue running in your terminal and watch all relevant files for changes. Webpack will then automatically recompile your assets when it detects a change.
5. For production run the `npm run production` command and it will run all Mix tasks and minify output.

# Files to Edit
- `source/css/mu-starter-plugin.css` - File should be renamed from `mu-starter-plugin.css` to match the plugin name.
- `mu-starter-plugin.php` - File should be renamed from `mu-starter-plugin.php` to match the plugin name. Also, the function `mu_starter_plugin_scripts` should be updated to match the plugin name, as well as the CSS file `mu-starter-plugin.css` within the function that is enqueued. This CSS file should match the name given in `webpage.mix.js`.
- `tailwind.config.js` - If you need to extend TailwindCSS in anyway this is where you should do it. It is highly unlikely that you'd need to extend the default Marshall TailwindCSS theme though.
- `webpack.mix.js` - You need to update the file names in the mix.postCSS command to match the file names set.

The easiest way to make these updates is to do a search and find and change all `mu-starter-plugin` to your plugin name, for example `mu-profiles` and to do the same for `mu_starter_plugin` you'd replace with `mu_profiles`.
