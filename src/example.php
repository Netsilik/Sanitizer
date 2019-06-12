<pre><?php
error_reporting(~0);
/**
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @licence EUPL (European Union Public Licence, version 1.1)
 */


$_TEST['userId'] = 10;
$_TEST['textField'] = 'hallo';
$_TEST['array'][0] = 'foo';
$_TEST['array'][1] = 'bar';
$_TEST['array'][2] = 'foo';

require_once(__DIR__.'/sanitizer.class.php');

// Object creation
$_SANITIZED = null; // define your result array
$sanitizer = new Sanitizer($_SANITIZED); // Instantiate sanitizer object with a reference to our result array as construction argument

// variable sanitization:
$sanitizer->int($_TEST, 'userId');
$sanitizer->utf8($_TEST, 'textField', '', true, 1000);
$sanitizer->ascii($_TEST, 'array', 0);

var_dump( Sanitizer::int('TEST') );

var_dump( $_SANITIZED );
