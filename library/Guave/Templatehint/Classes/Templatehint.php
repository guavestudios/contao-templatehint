<?php

namespace Guave\Templatehint\Classes;

use Contao\Controller;

class Templatehint {

	protected static $instance = null;

	protected function __construct() {

		if($this->isFrontendhintActive()) {
			//register css
			$GLOBALS['TL_FRAMEWORK_CSS'][] = 'system/modules/templatehint/assets/css/templatehint.css';
		}

	}

	/**
	 * @return Templatehint|null
	 */
	public static function getInstance() {
		if(!self::$instance) {
			self::$instance = new Templatehint();
		}
		return self::$instance;
	}


	/**
	 * @param string $buffer
	 * @param string $template
	 * @return string
	 */
	public function parseFronendTemplateHint($buffer, $template) {

		if(TL_MODE != 'FE' || !$this->isFrontendhintActive()) {
			return $buffer;
		}

		return $this->parseTempateHint($buffer, $template);

	}


	/**
	 * @param string $buffer
	 * @param string $template
	 * @return string
	 */
	public function parseTempateHint($buffer, $template) {

		$return = '';
		$return .= '<div class="templatehint-container">';
		$return .= '<div class="templatehint-div templatehint-template templatehint-hover">'.$this->getTemplate($template).'</div>';
		$return .= '<div class="templatehint-div templatehint-class templatehint-hover">'.$this->getCalledClass().'</div>';
		$return .= $buffer;
		$return .= '</div>';

		return $return;

	}

	/**
	 * @param string $template
	 * @return string
	 */
	public function getTemplate($template) {

		if(!$this->isTwigTemplate()) {
			return Controller::getTemplate($template);
		} else {

			$twig = \ContaoTwig::getInstance();
			$loader = $twig->getLoaderFilesystem();
			$template = $template.'.html5.twig';
			return $loader->getCacheKey($template);
		}

	}

	/**
	 * @return string class name
	 */
	public function getCalledClass() {

		$backtrace = debug_backtrace();
		if(!$this->isTwigTemplate()) {
			foreach ($backtrace as $k => $v) {
				if ($v['class'] != get_class($this) && $v['class'] != 'Contao\FrontendTemplate') {
					return $v['class'];
				}
			}
		} else {

			foreach ($backtrace as $k => $v) {
				$class =  get_class($v['object']);
				if (substr($class, 0, 4) != 'Twig' && $v['class'] != get_class($this)) {
					return $class;
				}
			}

		}

	}

	/**
	 * @return bool
	 */
	public function isFrontendhintActive(){
		if($_SESSION['templatehint']['enableFrontendhint']) {
			return true;
		}
		return false;
	}

	/**
	 * @return bool
	 */
	public function isTwigTemplate(){

		$backtrace = debug_backtrace();

		$isTwig = false;
		foreach($backtrace as $k => $v) {
			if(substr($v['class'], 0, 4) == 'Twig') {
				$isTwig = true;
				break;
			}
		}

		return $isTwig;

	}


}