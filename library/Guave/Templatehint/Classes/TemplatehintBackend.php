<?php
/**
 * Created by PhpStorm.
 * User: Gebhard
 * Date: 25.06.2015
 * Time: 11:15
 */

namespace Guave\Templatehint\Classes;


class TemplatehintBackend {

	/**
	 * @param string $value
	 * @param \Contao\DC_File $dc
	 * @return string
	 */
	public function loadFieldValue($value, $dc){

		$field = $dc->field;
		return $_SESSION['templatehint'][$field];

	}

	/**
	 * @param string $value
	 * @param \Contao\DC_File $dc
	 * @return null return always null, so it does not save the value in file
	 */
	public function saveFieldValue($value, $dc){

		$field = $dc->field;
		$_SESSION['templatehint'][$field] = $value;

		return null; //doNotSaveEmpty

	}
	
}