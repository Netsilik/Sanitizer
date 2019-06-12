<?php
namespace Netsilik\Lib\Sanitizer\Plugin;
/**
 * @package       Core
 * @version       1.77
 * @date          2012-07-14
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @license       EUPL (European Union Public Licence, v.1.1)
 */

use Netsilik\Lib\Sanitizer\SanitizerPlugin;

/**
 * Force data to be valid file name characters
 *
 * @return string
 */
class SanitizerPlugin_FileName extends SanitizerPlugin
{
	// Allowed characters (81):
	//     !#$%&(),-.01234
	//    56789;=@ABCDEFGH
	//    IJKLMNOPQRSTUVWX
	//    YZ^_abcdefghijkl
	//    mnopqrstuvwxyz{}
	//    ~
	// Note: first character is a space
	protected $_regEx     = '/[^a-z0-9_0x20!#$%&(),\\-\\.;=@^{}~]/i';
	
	protected $_maxLength = 254;
}
