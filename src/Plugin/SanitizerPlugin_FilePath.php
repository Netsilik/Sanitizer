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
 * Force data to be valid file path characters
 *
 * @return string
 * @warning:
 * ** ******************************************************************* **
 * ** WARNING: The sanitized results are not 'safe', escape as nessecary! **
 * ** ******************************************************************* **
 */
class SanitizerPlugin_FilePath extends SanitizerPlugin
{
	// Allowed characters (82):
	//     !#$%&(),-./0123
	//    456789;=@ABCDEFG
	//    HIJKLMNOPQRSTUVW
	//    XYZ^_abcdefghijk
	//    lmnopqrstuvwxyz{
	//    }~
	// Note: first character is a space
	protected $regEx     = '/[^a-z0-9_0x20!#$%&(),\\-\\.\\/;=@^{}~]/i';
	
	protected $maxLength = 4080; // 255 * 16 (if this is not sufficient, then something needs to be redesigned)
}
