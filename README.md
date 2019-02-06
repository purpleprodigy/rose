# Rose Theme

A feature packed, clean and professional Genesis child theme.


## Features

#### Gutenberg Support
Built in support for the new WordPress editor which allows you to utilize all of the latest features.

#### Custom Colors
Rose provides custom color settings with transparency options giving you even more control over your theme's colors

#### SEO Slider
We built an entirely new plugin for this theme because all the other slider plugins weren't SEO friendly enough

#### Transparent Header
Change the look of the site-header from the Customizer. Choose from either transparent or default

#### Sticky Header
Enable a sticky header that stays in the viewport on scroll from the Customizer

#### Accessibility
Accessibility friendly content that can be navigated with ease using the keyboard

#### Templates & Layouts
Custom page templates and layouts provide plenty of options for displaying your content

#### Portfolio
Showcase your projects in style using the Display Posts Shortcode


## Recommendations

* PHP > 7.0
* WordPress > 5.0
* Genesis Framework > 2.8
* Node.js > 6.9
* Gulp.js > 3.9 


## Installation

1. Upload and install Genesis
2. Upload, install and activate Rose
3. Install and activate recommended plugins

## Development

Rose uses [Gulp](http://gulpjs.com/) as a build tool and [npm](https://www.npmjs.com/) to manage front-end packages.

### Install dependencies

From the command line on your host machine, navigate to the theme directory then run `npm install`:

```shell
# @ themes/your-theme-name/
$ npm install
```

You now have all the necessary dependencies to run the build process.

### Build commands

* `gulp styles` — Compile, autoprefix and minify Sass files.
* `gulp scripts` — Minify javascript files.
* `gulp images` — Compress and optimize images.
* `gulp watch` — Compile assets when file changes are made, start Browsersync
* `gulp` — (Default task) runs all of the above tasks.


#### Additional commands

* `gulp translate` — Scan the theme and create `rose.pot` POT file.
* `gulp zip` — Package theme into zip file for distribution, ignoring `node_modules`.
* `gulp bump` - Bumps version number in all files. See options in example below.
  - `--major` version when you make incompatible API changes
  - `--minor` version when you add functionality in a backwards-compatible manner
  - `--patch` version when you make backwards-compatible bug fixes
  - `--to` allows you to define a custom version number, e.g. `gulp bump --to 0.1.0`
* `gulp rename` - Rename theme Title, Text Domain and Function Prefix.
  - `--to` name for your theme e.g: `gulp rename --to your-theme-name`


### Using Browsersync

To use Browsersync you need to update the proxy URL in `gulpfile.js` to reflect your local development hostname.

If your local development URL is `my-site.dev`, update the file to read:

```javascript
...
  proxy: 'my-site.dev',
...
```

By default, BrowserSync is configured to use an SSL certificate for local development. If using a Non-HTTPS local site, remove the HTTPS BrowserSync configuration and uncomment the HTTP settings.

## License

This project is licensed under the GNU General Public License - see the LICENSE.md file for details.


## Acknowledgments

A shout out to anyone who's code was used:

- Lee Anthony
- Gary Jones
- Tim Jensen
- Craig Watson
- Bill Erickson
- Sridhar Katakam
- Chinmoy Paul
- Nathan Rice
- Calvin Koepke
- Jen Baumann
- Brian Gardner
- Robin Cornett
