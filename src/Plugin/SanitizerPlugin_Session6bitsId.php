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

class SanitizerPlugin_Session6bitsId extends SanitizerPlugin
{
	protected $maxLength = 27;
	
	protected $regEx     = '/[^0-9A-Z\\-,]/i';
}