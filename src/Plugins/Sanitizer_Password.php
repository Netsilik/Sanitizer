<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid user provided password string. (All utf-8 printable characters)
 *
 * @return string
 */
class Sanitizer_Password extends Sanitizer_Utf8
{
	protected $_maxLength = 256;
}
