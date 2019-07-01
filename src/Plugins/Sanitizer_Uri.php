<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid uri characters
 *
 * @return string
 */
class Sanitizer_Uri extends AbstractSanitizer
{
	// As specified in: RFC 2396
	protected $_regEx = '/[^a-z0-9_$\\-\\.+!*\'(),{}\\|\\\\^~\\[\\]`<>#%";\\/?:@&=]/i';
}
