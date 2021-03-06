<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2014 Daniel Kiesel
 *
 * @package AccountMail
 * @link    https://github.com/craffft/contao-accountmail
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

// Config
$GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = array(
    'Craffft\\AccountMail\\Member\\Account',
    'handlePalettesAndSubpalettes'
);
$GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = array(
    'Craffft\\AccountMail\\Member\\Account',
    'setAutoPassword'
);
$GLOBALS['TL_DCA']['tl_member']['config']['onsubmit_callback'][] = array(
    'Craffft\\AccountMail\\Member\\Account',
    'sendPasswordEmail'
);

// Palettes
if (is_array($GLOBALS['TL_DCA']['tl_member']['palettes'])) {
    foreach ($GLOBALS['TL_DCA']['tl_member']['palettes'] as $k => $v) {
        $GLOBALS['TL_DCA']['tl_member']['palettes'][$k] = preg_replace(
            '#([,;]+)password([,;]?)#',
            '$1password,sendLoginData$2',
            $v
        );
    }
}

// Subpalettes
if (is_array($GLOBALS['TL_DCA']['tl_member']['subpalettes'])) {
    foreach ($GLOBALS['TL_DCA']['tl_member']['subpalettes'] as $k => $v) {
        $GLOBALS['TL_DCA']['tl_member']['subpalettes'][$k] = preg_replace(
            '#([,;]+)password([,;]?)#',
            '$1password,sendLoginData$2',
            $v
        );
    }
}

// Fields
$GLOBALS['TL_DCA']['tl_member']['fields']['sendLoginData'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['sendLoginData'],
    'exclude'   => true,
    'default'   => 1,
    'inputType' => 'checkbox',
    'eval'      => array('tl_class' => 'w50'),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['loginDataAlreadySent'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_member']['loginDataAlreadySent'],
    'sql'   => "char(1) NOT NULL default ''"
);
