<?php
namespace Netsilik\Sanitizer;

use Netsilik\Sanitizer\Interfaces\iSantizerPlugin;


class Sanitizer
{
	/**
	 * @var array $_sanitizers All instantiated sanitzers
	 */
	private $_sanitizers = [];
	
	/**
	 * @var array $_errors
	 */
	private $_errors = [];
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		//
	}
	
	/**
	 * Magic method that delegates the virtual method calls to their actual object instances (magic factory pattern)
	 *
	 * @param string $sanitizer name of the magic-method to call
	 * @param array $args the arguments to feed to the magic santizer method, array $args() in the format:
	 *                    [mixed $value, scalar $default = null, int $maxLength = null, bool $silent = false]
	 *
	 * @return mixed The sanitized value
	 */
	public function __call(string $sanitizer, array $args)
	{
		$value     = isset($args[0]) ? $args[0] : null;
		$default   = isset($args[1]) ? $args[1] : null;
		$maxLength = isset($args[2]) ? $args[2] : null;
		$silent    = isset($args[3]) ? $args[3] : false;
		
		if (null === $value) {
			trigger_error(__CLASS__ . '::' . $sanitizer . '() expects at least 1 parameters, 0 given', E_USER_ERROR);
		}
		
		// Instantiate the requested sanitizer if required
		if (!isset($this->_sanitizers[ $sanitizer ])) {
			$this->_instantiateSanitizer($sanitizer);
		}
		
		// Let's sanitize
		if (null === ($sanitized = $this->_sanitizers[ $sanitizer ]->sanitize($value, $maxLength, $silent))) {
			return $default;
		}
		
		return $sanitized;
	}
	
	/**
	 *
	 * @return array
	 */
	public function getLastErrors() : string
	{
		return $this->_errors;
	}
	
	/**
	 * Get the last error
	 *
	 * @return string|null
	 */
	public function getLastError() : ?string
	{
		if (false !== ($error = end($this->_errors))) {
			return $error;
		}
		
		return null;
	}
	
	/**
	 * Instantiate a sanitizer
	 *
	 * @param string $sanitizer
	 *
	 * @return void
	 */
	private function _instantiateSanitizer(string $sanitizer) : void
	{
		$sanitizerClassName = __NAMESPACE__ . '\\Plugins\\Sanitizer_' . ucfirst($sanitizer);
		
		if (!class_exists($sanitizerClassName)) {
			trigger_error('Sanitizer ' . $sanitizer . ' does not exist', E_USER_ERROR);
		}
		
		$instance = new $sanitizerClassName();
		
		if (!($instance instanceof iSantizerPlugin)) {
			trigger_error('Sanitizer ' . $sanitizer . ' is not a valid plugin', E_USER_ERROR);
		}
		
		$this->_sanitizers[ $sanitizer ] = $instance;
	}
	
	/**
	 * Destructor
	 */
	public function __destruct()
	{
		$this->_sanitizers = [];
	}
}
