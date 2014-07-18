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

/**
 * Table tl_email
 */
$GLOBALS['TL_DCA']['tl_email'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'               => 'File'
    ),

    // Palettes
    'palettes' => array
    (
        'default'                     => '{emailSender_legend},emailFrom,emailFromName'
    ),

    // Fields
    'fields' => array
    (
        // Email sender
        'emailFrom' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email']['emailFrom'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'email', 'tl_class'=>'w50')
        ),
        'emailFromName' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email']['emailFromName'],
            'exclude'                 => true,
            'inputType'               => 'TranslationTextField',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'alpha', 'tl_class'=>'w50')
        )
    )
);

/**
 * Add email fields dynamically
 */
if (is_array($GLOBALS['TL_EMAIL'])) {
    foreach ($GLOBALS['TL_EMAIL'] as $name => $item) {
        $GLOBALS['TL_DCA']['tl_email']['palettes']['default'] .= sprintf(';{%s_legend:hide}', $name);
        $GLOBALS['TL_DCA']['tl_email']['palettes']['default'] .= sprintf(',%s%s', $name, 'Subject');
        $GLOBALS['TL_DCA']['tl_email']['palettes']['default'] .= sprintf(',%s%s', $name, 'Template');
        $GLOBALS['TL_DCA']['tl_email']['palettes']['default'] .= sprintf(',%s%s', $name, 'Content');

        $GLOBALS['TL_DCA']['tl_email']['fields'][$name . 'Subject'] = array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email']['emailSubject'],
            'exclude'                 => true,
            'inputType'               => 'TranslationTextField',
            'options'                 => $item['parameters'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_email']['parameters'],
            'eval'                    => array('mandatory'=>true, 'helpwizard'=>true, 'tl_class'=>'w50')
        );

        $GLOBALS['TL_DCA']['tl_email']['fields'][$name . 'Template'] = array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email']['emailTemplate'],
            'default'                 => 'mail_default',
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_email', 'getMailTemplates'),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
        );

        $GLOBALS['TL_DCA']['tl_email']['fields'][$name . 'Content'] = array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_email']['emailContent'],
            'exclude'                 => true,
            'inputType'               => 'TranslationTextArea',
            'options'                 => $item['parameters'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_email']['parameters'],
            'eval'                    => array('mandatory'=>true, 'helpwizard'=>true, 'rte'=>'tinyFlash', 'tl_class'=>'clr')
        );
    }
}

class tl_email extends \Backend
{
    public function getMailTemplates()
    {
        return $this->getTemplateGroup('mail_');
    }
}