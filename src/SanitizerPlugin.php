<?php
namespace Netsilik\Lib\Sanitizer;
/**
 * @package Core
 * @version 1.77
 * @date 2012-07-14
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @license EUPL (European Union Public Licence, v.1.1)
 */

 
/**
 * class SanitizerPlugin() abstract class for all sanitizer plugin classes called as magic methods by class Sanitizer
 * @abstract
 */
abstract class SanitizerPlugin {
	/**
	 * @var string $regEx The regular expression for sanitizing
	 */
	protected $regEx = '/[^]/';
	
	/**
	 * @var int $maxLength The default maximum sanitized string length
	 */
	protected $maxLength = 255;
	
	/**
	 * @var bool $forceLength Flag to force exact length sanitization
	 */
	protected $forceLength = false;
	
	/**
	 * @var string The last error
	 */
	protected $errorStr = '';
	
	/**
	 * constructor
	 */
	final public function __construct() {
		if ( substr(get_class($this), strlen(__NAMESPACE__)+1, 16) <> 'SanitizerPlugin_') {
			trigger_error(get_class($this).'() Derived SanitizerPlugin class name must start with \'SanitizerPlugin_\'', E_USER_ERROR);
		}
		$caller = $this->getCaller(3);
		if ( ! isset($caller['class']) || $caller['class'] <> __NAMESPACE__.'\\Sanitizer') {
			trigger_error(get_class($this).'() Derived SanitizerPlugin class is to be called through class Sanitizer', E_USER_ERROR);
		}
	}
	
	/**
	 * Returns callstack, used in tirggered errors
	 * @param int $step the number of caller-steps to trace back
	 * @return array the callstack array
	 */
	protected function getCaller($step) {
		$callStack = debug_backtrace();
		return isset($callStack[$step]) ? $callStack[$step] : array();
	}
	
	/**
	 * get destription for the last error
	 * @return string error description
	 */
	public function getError() {
		return $this->errorStr;
	}
	
	/**
	 * get the normalized class name for 'this'
	 * @return string normalized class name for 'this'
	 */
	protected function getType() {
		$className = substr(get_class($this), 10);
		$className[0] = strtolower($className[0]);
		return $className;
	}
	
	/**
	 * This method does all the work
	 * @param mixed $data the data to sanitize
	 * @param bool $silent if set to false, this method will raise an error of level Notice if @param $data needed sanitizing
	 * @param int $maxLength the maximum string length to allow return
	 * @return mixed the sanitized result (a single return type is defined by the derived classes)
	 */
	public function sanitize($data, $silent, $maxLength) {
		$this->errorStr = '';
		if (is_null($maxLength) || $this->forceLength) {
			$maxLength = $this->maxLength;
		}
		
		if ( ! $silent) {
			if ($this->forceLength && strlen($data) != $maxLength) {
				$this->errorStr = 'Data length is '.(strlen($data)).', '.$maxLength.' required';
				return null;
			} elseif (strlen($data) > $maxLength) {
				$this->errorStr = 'Data length is '.(strlen($data) - $maxLength).' characters oversized';
				return null;
			} elseif (preg_match($this->regEx, $data)) {
				$this->errorStr = 'Invalid characters encounterd in '.$this->getType().' data';
				return null;
			}
		}
		$sanitized = preg_replace($this->regEx, '', $data);
		if ($this->forceLength) {
			$sanitized = str_pad($sanitized, $maxLength, '0', STR_PAD_LEFT);
		}
		return (string)$sanitized;
	}
}
