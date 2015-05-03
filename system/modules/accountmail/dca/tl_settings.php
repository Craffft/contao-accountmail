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

// Palettes
$strPalette = '{accountmail_legend},disableMemberAccountMail,disableUserAccountMail';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = preg_replace(
    '#([;]?)$#',
    ';' . $strPalette,
    $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
);

// Fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['disableMemberAccountMail'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['disableMemberAccountMail'],
    'inputType' => 'checkbox',
    'eval'      => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['disableUserAccountMail'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['disableUserAccountMail'],
    'inputType' => 'checkbox',
    'eval'      => array('tl_class' => 'w50')
);
