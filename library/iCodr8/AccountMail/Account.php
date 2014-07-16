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

class Account extends \Controller
{
    public function setAutoPassword(\DataContainer $dc)
    {
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

    public function sendPasswordEmail(\DataContainer $dc)
    {
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
                $objEmail = new \Email();
                $objEmail->from = $GLOBALS['TL_ADMIN_EMAIL'];
                $objEmail->fromName = $GLOBALS['TL_ADMIN_NAME'];

                // Password changed the first time
                if ($dc->activeRecord->login == 1) {
                    $strSubject = 'TODO';
                    $strText = 'TODO';
                } else {
                    $strSubject = 'TODO';
                    $strText = 'TODO';
                }

                $objEmail->subject = $this->replaceParameters($dc, $strSubject);
                $objEmail->text = $this->replaceParameters($dc, $strText);

                // Send email
                $objEmail->sendTo($dc->activeRecord->email);

                // Disable sendLoginData field
                $dc->activeRecord->sendLoginData = '';

                // Disable sendLoginData field in the database
                \Database::getInstance()->prepare("UPDATE " . $dc->table . " SET sendLoginData='' WHERE id=?")->execute($dc->activeRecord->id);

                // Show success message
                \Message::addConfirmation($GLOBALS['TL_LANG']['MSC']['login_data_send']);
            }
        }
    }

    protected function getParameters(\DataContainer $dc)
    {
        $arrParameters = array();
        $arrParameters['host'] = \Idna::decode(\Environment::get('host'));
        $arrParameters['admin_name'] = \BackendUser::getInstance()->name;

        // HOOK: replaceAccountMailParameters
        if (isset($GLOBALS['TL_HOOKS']['replaceAccountMailParameters']) && is_array($GLOBALS['TL_HOOKS']['replaceAccountMailParameters']))
        {
            foreach ($GLOBALS['TL_HOOKS']['replaceAccountMailParameters'] as $callback)
            {
                if (is_array($callback))
                {
                    $this->import($callback[0]);
                    $arrParameters = $this->$callback[0]->$callback[1]($dc, $arrParameters);
                }
                elseif (is_callable($callback))
                {
                    $arrParameters = $callback($dc, $arrParameters);
                }
            }
        }

        return $arrParameters;
    }

    protected function replaceParameters(\DataContainer $dc, $strText)
    {
        $arrParameters = $this->getParameters($dc);

        if (is_array($arrParameters)) {
            foreach ($arrParameters as $key => $varValue) {
                $strText = str_replace('{{' . $key . '}}', $varValue, $strText);
            }
        }

        return $strText;
    }
}
