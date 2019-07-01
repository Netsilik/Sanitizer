<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be of type word (aphanum and _)
 *
 * @return string
 */
class Sanitizer_Word extends AbstractSanitizer
{
	protected $_regEx = '/[^a-z0-9_]/i';
}
