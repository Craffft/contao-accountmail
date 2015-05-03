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

namespace Craffft\AccountMail\User;

class Account extends \Craffft\AccountMail\Account
{
    protected function isDisabledAccountMail(\DataContainer $dc)
    {
        if ($GLOBALS['TL_CONFIG']['disableUserAccountMail']) {
            return true;
        }

        return false;
    }
}
