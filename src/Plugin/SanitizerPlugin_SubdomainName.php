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
 * Force data to only contain characters valid in a subdomain name
 *
 * @return string
 */
class SanitizerPlugin_SubdomainName extends SanitizerPlugin
{
	protected $regex      = '/^[a-z0-9]+(\\-[a-z0-9]+)*$/i';
	
	protected $_maxLength = 64;
}
