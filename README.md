MU COS Courses
===
# Getting Started
1. Clone the repo
2. Run `composer install` to install required composer dependencies
2. Run `npm install` to install the required npm dependencies
3. In development you can run the `npm run watch` command and it will continue running in your terminal and watch all relevant files for changes. Laravel Mix will then automatically recompile your assets when it detects a change.
4. For production run the `npm run production` command and it will run all Larvel Mix tasks and minify output.

## Editing Files
Marsha uses TailwindCSS as the CSS framework and uses Laravel Mix to compile our TailwindCSS.

## Required Tools
The CSS and JavaScript for Marshall University's network of sites is developed using the following tools:

- [TailwindCSS](http://www.tailwindcss.com) - Tailwind is a utility-first CSS framework for rapidly building custom user interfaces that is at the base of CSS styling in Marsha.
- [Alpine.js](https://github.com/alpinejs/alpine) - Alpine.js is the JavaScript framework used in Marsha.
- [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) - Laravel Mix provides a fluent API for defining Webpack build steps for your application using several common CSS and JavaScript pre-processors and is used to compile the TailwindCSS.
