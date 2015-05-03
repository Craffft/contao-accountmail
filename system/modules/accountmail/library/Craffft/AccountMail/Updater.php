<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2014-2015 Daniel Kiesel
 *
 * @package AccountMail
 * @link    https://github.com/craffft/contao-accountmail
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Craffft\AccountMail;

class Updater extends \Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->import('Config');

        // Load required translation-fields classes
        \ClassLoader::addNamespace('TranslationFields');
        \ClassLoader::addClass('TranslationFields\TranslationFieldsWidgetHelper', 'system/modules/translation-fields/classes/TranslationFieldsWidgetHelper.php');
        \ClassLoader::addClass('TranslationFields\TranslationFieldsModel', 'system/modules/translation-fields/models/TranslationFieldsModel.php');
        \ClassLoader::register();
    }

    /**
     * Add default email contents to the configuration fields of the accountmail extension
     */
    public function addDefaultEmailContents()
    {
        $this->addContentToField('emailFrom', $this->Config->get('adminEmail'));
        $this->addContentToField('emailNewMemberTemplate', 'mail_default');
        $this->addContentToField('emailChangedMemberPasswordTemplate', 'mail_default');
        $this->addContentToField('emailNewUserTemplate', 'mail_default');
        $this->addContentToField('emailChangedUserPasswordTemplate', 'mail_default');

        foreach ($this->getFieldNames() as $strField) {
            $this->addTranslationContentToField($strField);
        }
    }

    /**
     * @param $strField
     * @param $strValue
     */
    protected function addContentToField($strField, $strValue)
    {
        if ($this->Config->get($strField) === null) {
            $this->Config->persist($strField, $strValue);
        }
    }

    /**
     * @return array
     */
    protected function getFieldNames()
    {
        $arrFields = array();
        $arrFields[] = 'emailFromName';

        foreach ($GLOBALS['TL_EMAIL'] as $strField) {
            $arrFields[] = $strField . 'Subject';
            $arrFields[] = $strField . 'Content';
        }

        return $arrFields;
    }

    /**
     * @param $strField
     */
    protected function addTranslationContentToField($strField)
    {
        if ($this->Config->get($strField) === null) {
            $arrValues = array();

            \System::loadLanguageFile('tl_email', 'de', true);
            $arrValues['de'] = $GLOBALS['TL_LANG']['tl_email']['defaultContents'][$strField];

            \System::loadLanguageFile('tl_email', 'en', true);
            $arrValues['en'] = $GLOBALS['TL_LANG']['tl_email']['defaultContents'][$strField];

            // Load translation file by current language
            \System::loadLanguageFile('tl_email', null, true);

            $this->Config->persist(
                $strField,
                \TranslationFieldsWidgetHelper::saveValuesAndReturnFid($arrValues)
            );
        }
    }
}
