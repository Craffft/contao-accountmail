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

class Hooks
{
    public function replaceAccountMailParameters(\DataContainer $dc, $arrParameters)
    {
        switch ($dc->table) {
            case 'tl_member':
                $arrParameters['firstname'] = $dc->activeRecord->firstname;
                $arrParameters['lastname'] = $dc->activeRecord->lastname;
                $arrParameters['username'] = $dc->activeRecord->username;
                $arrParameters['password'] = \Input::post('password');
                break;

            case 'tl_user':
                $arrParameters['name'] = $dc->activeRecord->name;
                $arrParameters['username'] = $dc->activeRecord->username;
                $arrParameters['password'] = \Input::post('password');
                break;
        }

        return $arrParameters;
    }
}
