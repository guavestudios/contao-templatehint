<?php

//register hooks
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('Guave\Templatehint\Classes\Templatehint', 'parseFronendTemplateHint');
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Guave\Templatehint\Classes\Templatehint', 'addAssets');