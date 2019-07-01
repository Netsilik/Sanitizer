<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be of ascii printable, LF, tab or CR
 *
 * @return string
 */
class Sanitizer_Ascii extends AbstractSanitizer
{
	/**
	 * Allowed characters (95):
	 *     !"#$%&'()*+,-./
	 *    0123456789:;<=>?
	 *
	 * @ABCDEFGHIJKLMNO
	 *    PQRSTUVWXYZ[\]^_
	 *    `abcdefghijklmno
	 *    pqrstuvwxyz{|}~
	 * Note: the first character is a space
	 * Also allowed:
	 *    tab, CR and LF
	 *
	 * @var string $_regEx
	 */
	protected $_regEx = '/[^a-z0-9_\\s!"#%&\'()*+,\\-\\.\\/:;<=>?@\\[\\]\\\\{\\|}\\^`~]/i';
}
