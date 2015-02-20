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

namespace iCodr8\AccountMail\Member;

class Account extends \iCodr8\AccountMail\Account
{
    protected function disableAccountMail(\DataContainer $dc)
    {
        if ($GLOBALS['TL_CONFIG']['disableMemberAccountMail']) {
            return true;
        }

        return false;
    }
}
