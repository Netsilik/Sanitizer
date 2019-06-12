<?php
namespace Netsilik\Lib\Sanitizer;

require_once(__DIR__ . '/SanitizerPlugin.php'); // Plugins do not autoload

/**
 * @package Core
 * @version 1.77
 * @date 2012-07-14
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @license EUPL (European Union Public Licence, v.1.1)
 * 
 * NOTE:
 *   In sanitizer regular expressions, avoid the use of \w. In PHP \w is locale dependent, so it could very well match unexpected characters
 *   See also: http://www.php.net/manual/en/regexp.reference.backslash.php
 *
 * Example of usage:
 * 
 *   // Object creation
 *   $_SANITIZED = array(); // define your result array
 *   $sanitizer = new Sanitizer($_SANITIZED); // Instantiate sanitizer object with a reference to our result array as construction argument
 *
 *   // variable Sanitizer:
 *   $sanitizer->int($_POST, 'userId', 0);
 *   $sanitizer->utf8($_POST, 'textField', '', true);
 * 
 *   var_dump( $_SANITIZED );
 *
 *   // Alternate (static) usage (available in PHP >= 5.3)
 *   var_dump( Sanitizer::utf8($_POST['textField'], '', true) );
 */


/**
 * class Sanitizer() cleans those incomming variables of unwanted characters
 * @uses error
 * @note Sanitizer only discards non-whitelisted characters, no form, order nor syntax whatsoever is checked
 */
class Sanitizer {
	/**
	 * @var array $_sanitizers All instantiated sanitzers
	 */
	private static $_sanitizers;
	
	/**
	 * @var string $_error The last error string
	 */
	private static $_error;
	
	/**
	 * @var array $_errors Errors by key
	 */
	private $_errors;
	
	/**
	 * @var array $_sanitized Reference to the array with the sanitized results
	 */
	private $_sanitized;
	
	/**
	 * constructor
	 * @param array &$sanitized reference to the array that will be filled with the sanitezed data
	 */
	public function __construct (&$sanitized = false) {
		self::$_sanitizers = array();
		self::$_error = '';
		$this->_errors = array();
		$this->_sanitized = &$sanitized;
	}
	
	/**
	 * Magic method that delegates the virtual method calls to their actual object instances (magic factory pattern)
	 * @param string $sanitizer name of the magic-method to call
	 * @param array $args the arguments to feed to the magic santizer method, array $args()
	 * @method mixed [sanitizer] (
	 *   array $variable
	 *   mixed $key
	 *   scalar $defaultValue = null
	 *   bool $silent = false
	 *   int $maxLength = [various]
	 * )
	 * @return bool on successful completing function call, false otherwise
	 */
	public function __call( $sanitizer, $args ) {
		self::$_error = '';
		if (count($args) < 2) {
			trigger_error('Missing argument '.(count($args) + 1), E_USER_WARNING);
			return false;
		} elseif ( ! isset($args[0]) ) { // Is this a possible outcome?
			trigger_error('Argument 1 is undefined, array expected', E_USER_WARNING);
			return false;
		} elseif ( ! is_array($args[0]) ) {
			trigger_error('Argument 1 is of type '.gettype($args[0]).', array expected', E_USER_WARNING);
			return false;
		} elseif ( ! is_scalar($args[1]) ) {
			trigger_error('Argument 2 is of type '.gettype($args[1]).', scalar expected', E_USER_WARNING);
			return false;
		}
		
		if ( ! isset(self::$_sanitizers[ $sanitizer ]) ) {
			self::instantiateSanitizer($sanitizer);
		}
		
		$defaultValue = isset($args[2]) ? $args[2] : null;
		$silent = isset($args[3]) ? $args[3] : false;
		$maxLength = isset($args[4]) ? $args[4] : null;
		
		// Let's sanitize
		if ( ! isset($args[0][ $args[1] ]) || is_null($args[0][ $args[1] ]) ) {
			if ( ! $silent) {
				$this->_errors[ $args[1] ] = self::$_error = 'Key does not exist';
			}
			$this->_sanitized[ $args[1] ] = $defaultValue; // set default value
			return false;
		}
		
		if ( is_array($args[0][ $args[1] ]) ) {
			foreach ($args[0][ $args[1] ] as $key => $data) {
				if ( empty($data) ) { // Let's not waste cpu time
					$this->_sanitized[ $args[1] ][ $key ] = $data;
				} else { 
					$this->_sanitized[ $args[1] ][ $key ] = self::$_sanitizers[ $sanitizer ]->sanitize($data, $silent, $maxLength);
					if ($this->_sanitized[ $args[1] ][ $key ] === null) {
						$this->_sanitized[ $args[1] ] = $defaultValue;
						$this->_errors[ $args[1] ] = self::$_error = self::$_sanitizers[ $sanitizer ]->getError().', for key '.$key;
					}
				}
			}
		} elseif ( empty($args[0][ $args[1] ]) ) { // Let's not waste cpu time
			$this->_sanitized[ $args[1] ] = $args[0][ $args[1] ];
		} else {
			$this->_sanitized[ $args[1] ] = self::$_sanitizers[ $sanitizer ]->sanitize($args[0][ $args[1] ], $silent, $maxLength);
			if ($this->_sanitized[ $args[1] ] === null) {
				$this->_sanitized[ $args[1] ] = $defaultValue;
				$this->_errors[ $args[1] ] = self::$_error = self::$_sanitizers[ $sanitizer ]->getError();
			}
		}
		if (self::$_error <> '') {
			return false;
		}
		return true;
	}
	
	/**
	 * This function directly returs the sanitized data
	 * @param string $sanitizer name of the magic-method to call
	 * @param array $args the arguments to feed to the magic santizer method, array $args()
 	 * @method mixed [sanitizer] (
	 *   mixed $data
	 *   scalar $defaultValue = null
	 *   bool $silent = false
	 *   int $maxLength = [various]
	 * )
	 * @return the sanitized result data, null on failure
	 */
	public static function __callStatic( $sanitizer, $args ) {
		self::$_error = '';
		if ( ! isset(self::$_sanitizers[ $sanitizer ]) ) {
			self::instantiateSanitizer($sanitizer);
		}
		
		$defaultValue = isset($args[1]) ? $args[1] : null;
		$silent = isset($args[2]) ? $args[2] : false;
		$maxLength = isset($args[3]) ? $args[3] : null;
		
		// Let's sanitize
		if ( ! isset($args[0]) || is_null($args[0]) ) {
			if ( ! $silent) {
				self::$_error = 'Variable does not exist';
			}
			return $defaultValue;
		}
		
		if ( is_array($args[0]) ) {
			foreach ($args[0] as $key => $data) {
				if ( empty($data) ) { // Let's not waste cpu time
					$args[0][ $key ] = $data;
				} else {
					$args[0][ $key ] = self::$_sanitizers[ $sanitizer ]->sanitize($data, $silent, $maxLength);
					if ($args[0][ $key ] === null) {
						$args[0][ $key ] = $defaultValue;
						self::$_error = self::$_sanitizers[ $sanitizer ]->getError().', for key '.$key;
					}
				}
			}
			return $args[0];
		}
		if ( empty($args[0]) ) { // Let's not waste cpu time
			return $args[0];
		}
		$args[0] = self::$_sanitizers[ $sanitizer ]->sanitize($args[0], $silent, $maxLength);
		if ($args[0] === null) {
			self::$_error = self::$_sanitizers[ $sanitizer ]->getError();
			return $defaultValue;
		}
		return $args[0];
	}
	
	/**
	 * Get the last occured error
	 */
	public static function getLastError() {
		$error = self::$_error;
		self::$_error = '';
		return $error;
	}
	
	/**
	 * Get an error by key
	 * @param string $key the key to get an error for
	 */
	public function getError($key = null) {
		if ($key === null) {
			return $this->_errors;
		}
		return isset($this->_errors[$key]) ? $this->_errors[$key] : '';
	}
	
	/**
	 * Get a reference to the $this->_sanitized array;
	 * @return array A reference to the _sanitized
	 */
	public function getSanitized() {
		return $this->_sanitized;
	}
	
	/**
	 * Instantiate a sanitizer
	 * @param 
	 */
	private static function instantiateSanitizer( $sanitizer ) {
		$sanitizerClassName = __NAMESPACE__.'\\SanitizerPlugin_'.ucfirst($sanitizer);
	
		if ( ! class_exists($sanitizerClassName)) {
			trigger_error('Sanitizer '.$sanitizer.' could not be found', E_USER_ERROR);
		}
		elseif ( ! is_subclass_of($sanitizerClassName, __NAMESPACE__.'\\SanitizerPlugin')) {
			trigger_error($sanitizer.' is not a SanitizerPlugin subclass', E_USER_ERROR);
		}
		
		self::$_sanitizers[ $sanitizer ] = new $sanitizerClassName();
		return true;
	}
	
	/**
	 * destructor
	 */
	public function __destruct() {
		// Explicit destruct required
		self::$_sanitizers = array();
	}
}
