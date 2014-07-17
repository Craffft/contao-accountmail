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

namespace iCodr8\AccountMail;

use TranslationFields\TranslationFields;

class Email
{
    protected $strType;

    protected $strForceLanguage;

    protected $arrParameters = array();

    public function __construct($strType, $strForceLanguage = null)
    {
        if (isset($GLOBALS['TL_EMAIL'][$strType])) {
            $this->strType = $strType;
        }

        $this->strForceLanguage = $strForceLanguage;

        // Set default parameters
        $this->addParameter('host', \Idna::decode(\Environment::get('host')));
        $this->addParameter('admin_name', \BackendUser::getInstance()->name);
    }

    public function addParameter($key, $varValue)
    {
        $this->arrParameters[$key] = $varValue;
    }

    public function removeParameter($key)
    {
        if (isset($this->arrParameters[$key])) {
            unset($this->arrParameters[$key]);
        }
    }

    public function sendTo($strRecipient)
    {
        if (!$this->strType) {
            return false;
        }

        $objEmail = new \Email();

        $objEmail->from = $GLOBALS['TL_CONFIG']['emailFrom'];
        $strEmailFromName = \TranslationFields::translateValue($GLOBALS['TL_CONFIG']['emailFromName'], $this->strForceLanguage);

        // Add sender name
        if ($strEmailFromName != '')
        {
            $objEmail->fromName = $strEmailFromName;
        }

        $objEmail->embedImages = true;
        $objEmail->imageDir = TL_ROOT . '/';

        // Prepare html template
        $objTemplate = new \BackendTemplate($this->getTemplate());

        $objTemplate->title = $this->getSubject();
        $objTemplate->body = $this->getContent();
        $objTemplate->charset = $GLOBALS['TL_CONFIG']['characterSet'];
        $objTemplate->css = '';
        $objTemplate->recipient = $strRecipient;

        // Parse html template
        $objEmail->html = $objTemplate->parse();

        // Send email
        $objEmail->sendTo($strRecipient);

        // Rejected recipients
        if ($objEmail->hasFailures())
        {
            return false;
        }

        return true;
    }

    protected function getTemplate()
    {
        if (isset($GLOBALS['TL_CONFIG'][$this->strType . 'Template'])) {
            return $GLOBALS['TL_CONFIG'][$this->strType . 'Template'];
        }
    }

    protected function getSubject()
    {
        if (isset($GLOBALS['TL_CONFIG'][$this->strType . 'Subject'])) {
            return TranslationFields::translateValue($GLOBALS['TL_CONFIG'][$this->strType . 'Subject'], $this->strForceLanguage);
        }
    }

    protected function getContent()
    {
        if (isset($GLOBALS['TL_CONFIG'][$this->strType . 'Content'])) {
            return TranslationFields::translateValue($GLOBALS['TL_CONFIG'][$this->strType . 'Content'], $this->strForceLanguage);
        }
    }

    protected function replaceParameters($strText)
    {
        if (is_array($this->arrParameters)) {
            foreach ($this->arrParameters as $key => $varValue) {
                $strText = str_replace('{{' . $key . '}}', $varValue, $strText);
            }
        }

        return $strText;
    }
}
