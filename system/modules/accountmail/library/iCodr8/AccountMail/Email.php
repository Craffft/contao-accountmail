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

class Email extends \Controller
{
    /**
     * @var
     */
    protected $strType;

    /**
     * @var
     */
    protected $strForceLanguage;

    /**
     * @var array
     */
    protected $arrParameters = array();

    /**
     * @param $strType
     * @param null $strForceLanguage
     */
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

    /**
     * @param $key
     * @param $varValue
     */
    public function addParameter($key, $varValue)
    {
        $this->arrParameters[$key] = $varValue;
    }

    /**
     * @param $key
     */
    public function removeParameter($key)
    {
        if (isset($this->arrParameters[$key])) {
            unset($this->arrParameters[$key]);
        }
    }

    /**
     * @param $strRecipient
     * @return bool
     */
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
        $objEmail->subject = $this->getContent('subject');

        // Prepare html template
        $objTemplate = new \BackendTemplate($this->getEmailTemplate());

        $objTemplate->title = $this->getContent('subject');
        $objTemplate->body = $this->getContent();
        $objTemplate->charset = $GLOBALS['TL_CONFIG']['characterSet'];
        $objTemplate->css = '';
        $objTemplate->recipient = $strRecipient;

        // Parse html template
        $objEmail->html = $objTemplate->parse();

        // Send email
        try
        {
            $objEmail->sendTo($strRecipient);
        }
        catch (\Swift_RfcComplianceException $e)
        {
            return false;
        }

        // Rejected recipients
        if ($objEmail->hasFailures())
        {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    protected function getEmailTemplate()
    {
        if (isset($GLOBALS['TL_CONFIG'][$this->strType . 'Template'])) {
            return $GLOBALS['TL_CONFIG'][$this->strType . 'Template'];
        }
    }

    /**
     * @param string $strName
     * @return string
     */
    protected function getContent($strName = 'content')
    {
        $strName = ucfirst(strtolower($strName));

        if (isset($GLOBALS['TL_CONFIG'][$this->strType . $strName])) {
            $strContent = \TranslationFields::translateValue($GLOBALS['TL_CONFIG'][$this->strType . $strName], $this->strForceLanguage);

            $objSession = \Session::getInstance();
            $objSession->set('ACCOUNTMAIL_PARAMETERS', $this->arrParameters);

            $strContent = $this->replaceInsertTags($strContent, false);

            $objSession->remove('ACCOUNTMAIL_PARAMETERS');

            // Only for deprecated {{blabla}} tags
            $strContent = $this->replaceParameters($strContent);

            return $strContent;
        }
    }

    /**
     * @param $strText
     * @return string
     * @deprecated
     */
    protected function replaceParameters($strText)
    {
        if (is_array($this->arrParameters)) {
            foreach ($this->arrParameters as $key => $varValue) {
                $strText = str_replace('{{' . $key . '}}', $varValue, $strText);
            }
        }

        $strText = \String::parseSimpleTokens($strText, $this->arrParameters);
        $strText = \String::restoreBasicEntities($strText);

        return (string) $strText;
    }
}
