# PHP Plus!

PHP, but better.

Add new functionality to PHP with a range of helper functions that make life easier.

Got a common function people should know about? Add a pull request, and get helping!

### How to download

#### Composer

Simply add `stevenkellow/php-plus` to your composer.json file.

#### Download

Simply download PHP Plus and put the folder somewhere within your project.

Then, just add *one* line of code into a project file (replacing PATH_TO_PHP_PLUS with the directory of the folder)

`include_once( PATH_TO_PHP_PLUS . '/index.php' );`

and you'll be done.

## How to use

Version 1.1 comes with a loader, so you can choose when to include PHP Plus and which files you need.

To run with all functions, simply use:

`PHPPlus::load();`

This method accepts two paramaters, $include and $exclude so you can fine tune which files to load.

If you only want to load certain files, add them to the include array like so:

`PHPPlus::load( array( 'constants', 'math' ) );`

If you want to exclude certain files, add them to the exclude array like so:

`PHPPlus::load( false, array( 'strings', 'security' ) );`

The include paramater defaults to using all files, while the exclude paramater defaults to excluding no files, so there's no real need to mix and match those two!