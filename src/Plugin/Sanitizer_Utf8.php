<?php
namespace Netsilik\Sanitizer\Plugin;
/**
 * @package       Core
 * @version       1.77
 * @date          2012-07-14
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @license       EUPL (European Union Public Licence, v.1.1)
 */

use Netsilik\Sanitizer\Plugin\AbstractSanitizer;

/**
 * Force data to be of encoding UTF-8 with normalized newlines, excluding UTF-8 control characters
 *
 * All non UTF-8 strigs are assumed to be in encoding ISO 8859-1 (Latin-1) as per RFC 2616 section 3.7.1
 *
 * @return string
 */
class Sanitizer_Utf8 extends AbstractSanitizer
{
	protected $_regEx    = '/[^\\p{L}\\p{M}\\p{N}\\p{P}\\p{S}\\p{Z}\n]/u';
	
	public function sanitize($data, $silent, $maxLength = 0)
	{
		if (!function_exists('mb_strlen')) { // Check for Multibyte String support
			trigger_error('Multibyte String functionality not supported. Please enable the Multibyte String extension enabled or do not use this sanitizer', E_USER_ERROR);
		}
		
		if ($maxLength == 0) {
			$maxLength = $this->_maxLength;
		}
		if (!$this->checkUtf8Valid($data)) {
			if (!$silent) {
				$this->_errors[] = 'Data is not a valid UTF-8 byte pattern data';
				
				return null;
			}
			trigger_error('Data is not valid UTF-8, assuming ISO 8859-1 (Latin-1) encoding', E_USER_NOTICE);
			
			return utf8_encode($data); // Assume ISO 8859-1 (Latin-1)
		}
		
		$data      = $this->normalizeNewlines($data);
		$sanitized = preg_replace($this->_regEx, '', $data); // Remove control characters
		if (!$silent && $data <> $sanitized) {
			$this->_errors[] = 'Control characters encounterd in UTF-8 data';
			
			return null;
		}
		
		$data = iconv('UTF-8', 'UTF-8', $sanitized);
		if (!$silent && mb_strlen($data) > $maxLength) {
			$this->_errors[] = 'Data length is ' . (strlen($data) - $maxLength) . ' characters oversized';
			
			return null;
		}
		
		return mb_substr($data, 0, $maxLength);
	}
	
	/**
	 * Check for a valid UTF-8 byte pattern
	 *
	 * @param string $data the string to assert as UTF-8
	 *
	 * @return bool
	 */
	private function checkUtf8Valid($data)
	{
		if (!function_exists('iconv')) {
			// iconv is not defined, so we have to use regular expressions.
			// not that this is 20x to 25x slower than iconv
			
			// first: check for valid byte sequence
			$regEx = '[\\xC0-\\xDF]([^\\x80-\\xBF]|$)';
			$regEx .= '|[\\xE0-\\xEF].{0,1}([^\\x80-\\xBF]|$)';
			$regEx .= '|[\\xF0-\\xF7].{0,2}([^\\x80-\\xBF]|$)';
			$regEx .= '|[\\xF8-\\xFB].{0,3}([^\\x80-\\xBF]|$)';
			$regEx .= '|[\\xFC-\\xFD].{0,4}([^\\x80-\\xBF]|$)';
			$regEx .= '|[\\xFE-\\xFE].{0,5}([^\\x80-\\xBF]|$)';
			// second: check for valid trailing bytes
			$regEx .= '|[\\x00-\\x7F][\\x80-\\xBF]';
			$regEx .= '|[\\xC0-\\xDF].[\\x80-\\xBF]';
			$regEx .= '|[\\xE0-\\xEF]..[\\x80-\\xBF]';
			$regEx .= '|[\\xF0-\\xF7]...[\\x80-\\xBF]';
			$regEx .= '|[\\xF8-\\xFB]....[\\x80-\\xBF]';
			$regEx .= '|[\\xFC-\\xFD].....[\\x80-\\xBF]';
			$regEx .= '|[\\xFE-\\xFE]......[\\x80-\\xBF]';
			$regEx .= '|^[\\x80-\\xBF]';
			
			return preg_match("/$regEx/", $data) ? true : false;
		}
		
		return ($data == iconv('UTF-8', 'UTF-8', $data));
	}
	
	/**
	 * Replaces windows- and (old) mac newlines as well as the unicode line separator (U+2028) with the newline character (\n)
	 * Also replaces the unicode paragraph separator (U+2029) with two newlines characters (\n\n)
	 *
	 * @param string $data
	 *
	 * @return string
	 */
	private function normalizeNewlines($data)
	{
		return preg_replace(['/(\r\n?|\x{2028})/u', '/\x{2029}/u'], ["\n", "\n\n"], $data);
	}
}
