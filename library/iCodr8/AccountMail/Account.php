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

abstract class Account extends \Controller
{
    /**
     * @var array
     */
    protected $arrParameters = array();

    /**
     * @param \DataContainer $dc
     * @return mixed
     */
    abstract protected function isDisabledAccountMail(\DataContainer $dc);

    /**
     * @param \DataContainer $dc
     */
    public function handlePalettes(\DataContainer $dc)
    {
        if ($this->isDisabledAccountMail($dc)) {
            if (is_array($GLOBALS['TL_DCA'][$dc->table]['palettes'])) {
                foreach ($GLOBALS['TL_DCA'][$dc->table]['palettes'] as $k => $v) {
                    $GLOBALS['TL_DCA'][$dc->table]['palettes'][$k] = str_replace(',sendLoginData', '', $GLOBALS['TL_DCA'][$dc->table]['palettes'][$k]);
                }
            }
        }
    }

    /**
     * @param \DataContainer $dc
     */
    public function setAutoPassword(\DataContainer $dc)
    {
        if ($this->isDisabledAccountMail($dc)) {
            return;
        }

        if (\Input::post('password') !== null && \Input::post('password') == '') {
            $strModel = \Model::getClassFromTable($dc->table);
            $objAccount = $strModel::findByPk($dc->id);

            if ($objAccount !== null) {
                $strNewPassword = substr(str_shuffle('abcdefghkmnpqrstuvwxyzABCDEFGHKMNOPQRSTUVWXYZ0123456789'), 0, 8);

                \Input::setPost('password', $strNewPassword);
                \Input::setPost('password_confirm', $strNewPassword);

                \Message::addConfirmation($GLOBALS['TL_LANG']['MSC']['pw_changed']);

                $objAccount->password = \Encryption::hash($strNewPassword);
                $objAccount->save();
            }
        }
    }

    /**
     * @param \DataContainer $dc
     */
    public function sendPasswordEmail(\DataContainer $dc)
    {
        if ($this->isDisabledAccountMail($dc)) {
            return;
        }

        // Return if there is no active record
        if (!$dc->activeRecord) {
            return;
        }

        // Send login data
        if ($dc->activeRecord->sendLoginData == 1) {
            if (\Input::post('password') == '' || \Input::post('password') == '*****') {
                // Set empty password
                \Input::setPost('password', '');

                // Generate new password
                $this->setAutoPassword($dc);
            }

            if (\Input::post('password') != '' && \Input::post('password') != '*****') {
                $strType = $this->getType($dc);
                $arrParameters = $this->getParameters($dc);
                $strLanguage = $this->getAccountLanguage($dc);

                if (!strlen($strType)) {
                    return;
                }

                if ($this->sendEmail($dc->activeRecord->email, $strType, $arrParameters, $strLanguage)) {
                    // Disable sendLoginData field
                    $dc->activeRecord->sendLoginData = '';

                    // Disable sendLoginData field in the database
                    \Database::getInstance()->prepare("UPDATE " . $dc->table . " SET sendLoginData='', loginDataAlreadySent='1' WHERE id=?")->execute($dc->activeRecord->id);

                    // Show success message
                    \Message::addConfirmation($GLOBALS['TL_LANG']['MSC']['login_data_send']);
                } else {
                    // Show error message
                    \Message::addError($GLOBALS['TL_LANG']['MSC']['login_data_not_send']);
                }
            }
        }
    }

    /**
     * @param \DataContainer $dc
     * @return string
     */
    protected function getType(\DataContainer $dc)
    {
        $strType = 'emailNew%s';

        if ($dc->activeRecord->loginDataAlreadySent) {
            $strType = 'emailChanged%sPassword';
        }

        switch ($dc->table) {
            case 'tl_member':
                $strType = sprintf($strType, 'Member');
                break;

            case 'tl_user':
                $strType = sprintf($strType, 'User');
                break;

            default:
                return;
        }

        return $strType;
    }

    /**
     * @param \DataContainer $dc
     * @return array
     */
    protected function getParameters(\DataContainer $dc)
    {
        if (!$dc->activeRecord) {
            return array();
        }

        $dc->loadDataContainer($dc->table);

        $strType = $this->getType($dc);

        $arrParameters = array();
        $arrFields = $GLOBALS['TL_DCA'][$dc->table]['fields'];

        if (is_array($arrFields)) {
            foreach ($arrFields as $strField => $arrField) {
                if (isset($dc->activeRecord->$strField)) {
                    $arrParameters[$strField] = $dc->activeRecord->$strField;
                }
            }
        }

        // Replace the password, because it's generated new
        $arrParameters['password'] = \Input::post('password');

        // HOOK: replaceAccountMailParameters
        if (isset($GLOBALS['TL_HOOKS']['replaceAccountMailParameters']) && is_array($GLOBALS['TL_HOOKS']['replaceAccountMailParameters']))
        {
            foreach ($GLOBALS['TL_HOOKS']['replaceAccountMailParameters'] as $callback)
            {
                if (is_array($callback))
                {
                    $this->import($callback[0]);
                    $arrParameters = $this->$callback[0]->$callback[1]($strType, $arrParameters, $dc);
                }
                elseif (is_callable($callback))
                {
                    $arrParameters = $callback($strType, $arrParameters, $dc);
                }
            }
        }

        return $arrParameters;
    }

    /**
     * @param \DataContainer $dc
     * @return mixed
     */
    protected function getAccountLanguage(\DataContainer $dc)
    {
        if ($dc->activeRecord->langauge) {
            return $dc->activeRecord->langauge;
        }

        return;
    }

    /**
     * @param $strRecipient
     * @param $strType
     * @param $arrParameters
     * @return bool
     */
    protected function sendEmail($strRecipient, $strType, $arrParameters, $strForceLanguage = null)
    {
        $objEmail = new Email($strType);

        if (is_array($arrParameters)) {
            foreach ($arrParameters as $k => $v) {
                $objEmail->addParameter($k, $v);
            }
        }

        // Send email
        return $objEmail->sendTo($strRecipient);
    }
}
