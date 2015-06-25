<?php

//register hooks
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('Guave\Templatehint\Classes\Templatehint', 'parseFronendTemplateHint');