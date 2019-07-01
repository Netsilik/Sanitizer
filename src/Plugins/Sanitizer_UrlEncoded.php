<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid url-encoded characters
 *
 * @return string
 */
class Sanitizer_UrlEncoded extends AbstractSanitizer
{
	protected $_regEx = '/[^0-9A-F%]/';
}
