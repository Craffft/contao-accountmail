<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2014 Daniel Kiesel
 *
 * @package AccountMail
 * @link    https://github.com/icodr8/contao-accountmail
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

// Config
$GLOBALS['TL_DCA']['tl_user']['config']['onload_callback'][] = array(
    'iCodr8\\AccountMail\\User\\Account',
    'handlePalettes'
);
$GLOBALS['TL_DCA']['tl_user']['config']['onload_callback'][] = array(
    'iCodr8\\AccountMail\\User\\Account',
    'setAutoPassword'
);
$GLOBALS['TL_DCA']['tl_user']['config']['onsubmit_callback'][] = array(
    'iCodr8\\AccountMail\\User\\Account',
    'sendPasswordEmail'
);

// Palettes
if (is_array($GLOBALS['TL_DCA']['tl_user']['palettes'])) {
    foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $v) {
        if ($k == 'login') {
            continue;
        }

        $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = preg_replace('#([,;]+)password([,;]?)#',
            '$1password,sendLoginData$2', $v);
    }
}

// Fields
$GLOBALS['TL_DCA']['tl_user']['fields']['sendLoginData'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_user']['sendLoginData'],
    'exclude'   => true,
    'default'   => 1,
    'inputType' => 'checkbox',
    'eval'      => array('tl_class' => 'w50'),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_user']['fields']['loginDataAlreadySent'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_user']['loginDataAlreadySent'],
    'sql'   => "char(1) NOT NULL default ''"
);
