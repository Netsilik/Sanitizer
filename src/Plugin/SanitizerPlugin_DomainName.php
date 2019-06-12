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
 * Force data to be valid domain name characters
 *
 * @return string
 */
class SanitizerPlugin_DomainName extends SanitizerPlugin
{
	// As specified in: RFC 1123, (RFC 952)
	// Note: In non-compliance with RFC 1123, the _ is also allowed, since Microsoft never read those RFCs anyhow
	protected $regEx = '/[^a-z0-9_-\\.]/i';
}
