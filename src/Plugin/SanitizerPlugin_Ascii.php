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
 * Force data to be of ascii printable, LF, tab or CR
 *
 * @return string
 * @warning:
 * ** ******************************************************************* **
 * ** WARNING: The sanitized results are not 'safe', escape as nessecary! **
 * ** ******************************************************************* **
 */
class SanitizerPlugin_Ascii extends SanitizerPlugin
{
	// Allowed characters (95):
	//     !"#$%&'()*+,-./
	//    0123456789:;<=>?
	//    @ABCDEFGHIJKLMNO
	//    PQRSTUVWXYZ[\]^_
	//    `abcdefghijklmno
	//    pqrstuvwxyz{|}~
	// Note: the first character is a space
	// Also allowed:
	//    tab, CR and LF
	protected $regEx = '/[^a-z0-9_\\s!"#%&\'()*+,\\-\\.\\/:;<=>?@\\[\\]\\\\{\\|}\\^`~]/i';
}
