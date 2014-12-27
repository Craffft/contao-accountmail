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

class Helpwizard extends \Controller
{
    /**
     * @return array
     */
    public function getHelpwizardReferencesByMember()
    {
        return $this->getHelpwizardReferencesBy('tl_member');
    }

    /**
     * @return array
     */
    public function getHelpwizardReferencesByUser()
    {
        return $this->getHelpwizardReferencesBy('tl_user');
    }

    /**
     * @param $strTable
     * @return array
     */
    protected function getHelpwizardReferencesBy($strTable)
    {
        $arrReferences = array();

        $this->loadLanguageFile($strTable);
        $this->loadDataContainer($strTable);

        if (isset($GLOBALS['TL_DCA'][$strTable]['fields']) && is_array($GLOBALS['TL_DCA'][$strTable]['fields'])) {
            foreach ($GLOBALS['TL_DCA'][$strTable]['fields'] as $strField => $arrValues) {
                $strLabel = $strField;

                if (isset($arrValues['label'][0]) && strlen($arrValues['label'][0])) {
                    $strLabel = $arrValues['label'][0];
                }

                $arrReferences[] = array(
                    sprintf('{{%s::%s|%s}}', 'accountmail', $strField, 'refresh'),
                    sprintf($GLOBALS['TL_LANG']['MSC']['helpwizard_insert_tag'], $strLabel)
                );
            }
        }

        return $arrReferences;
    }
}
