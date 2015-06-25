<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes'] = str_replace('useSMTP;', '{templatehint_legend},enableFrontendhint;useSMTP;', $GLOBALS['TL_DCA']['tl_settings']['palettes']);

$GLOBALS['TL_DCA']['tl_settings']['fields']['enableFrontendhint'] = array(
	'label'                   => $GLOBALS['TL_LANG']['tl_settings']['enableFrontendhint'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class' => 'w50', 'doNotSaveEmpty' => true),
	'load_callback' => array(
		array('Guave\Templatehint\Classes\TemplatehintBackend', 'loadFieldValue')
	),
	'save_callback' => array(
		array('Guave\Templatehint\Classes\TemplatehintBackend', 'saveFieldValue')
	)
);