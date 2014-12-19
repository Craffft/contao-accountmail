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

class InsertTags
{
    public function replaceInsertTags($strTag)
    {
        $arrElements = explode('::', $strTag);

        if ($arrElements[0] == 'accountmail') {
            $objSession = \Session::getInstance();
            $arrData = $objSession->get('ACCOUNTMAIL_PARAMETERS');

            if (isset($arrData[$arrElements[1]])) {
                return $arrData[$arrElements[1]];
            }
        }

        return false;
    }
}
