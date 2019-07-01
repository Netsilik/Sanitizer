<?php
namespace Netsilik\Sanitizer\Plugins;

use Netsilik\Sanitizer\Interfaces\iSantizerPlugin;


/**
 * Abstract class for all sanitizer plugin classes called as magic methods by class Sanitizer
 *
 * @abstract
 */
abstract class AbstractSanitizer implements iSantizerPlugin
{
	const CLASS_NAME_PREFIX = __NAMESPACE__ . '\\Sanitizer_';
	
	/**
	 * @var string $_regEx The regular expression for sanitizing
	 */
	protected $_regEx = '/[^]/';
	
	/**
	 * @var array $_errors
	 */
	protected $_errors = [];
	
	/**
	 * @var int $_maxLength
	 */
	protected $_maxLength;
	
	/**
	 * constructor
	 */
	final public function __construct()
	{
		if (substr(get_class($this), 0, strlen(static::CLASS_NAME_PREFIX)) <> static::CLASS_NAME_PREFIX) {
			trigger_error(get_class($this) . '() Derived Sanitizer class name must start with \'Sanitizer_\'', E_USER_ERROR);
		}
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getErrors() : array
	{
		return $this->_errors;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getLastError() : ?string
	{
		if (false !== ($error = end($this->_errors))) {
			return $error;
		}
		
		return null;
	}
	
	/**
	 * get the normalized class name for 'this'
	 *
	 * @return string normalized class name for 'this'
	 */
	protected function _getType()
	{
		$className    = substr(get_class($this), 10);
		$className[0] = strtolower($className[0]);
		
		return $className;
	}
	
	/**
	 * This method does all the work
	 *
	 * @param string   $data      the data to sanitize
	 * @param int|null $maxLength the maximum string length to allow return
	 * @param bool     $silent    if set to false, this method will raise an error of level Notice if @param $data needed sanitizing
	 *
	 * @return mixed the sanitized result (a single return type is defined by the derived classes)
	 */
	public function sanitize(string $data, ?int $maxLength, bool $silent)
	{
		$maxLength ?: $this->_maxLength;
		
		if (!$silent) {
			if (preg_match($this->_regEx, $data)) {
				$this->_errors[] = 'Invalid characters encounterd in ' . $this->_getType() . ' data';
				
			}
			if (strlen($data) > $maxLength) {
				$this->_errorStr = 'Data length is ' . (strlen($data) - $maxLength) . ' characters oversized';
				
			}
		}
		
		$sanitized = preg_replace($this->_regEx, '', $data);
		if ($maxLength > 0) {
			return substr($sanitized, 0, $maxLength);
		}
		
		return $sanitized;
	}
}
