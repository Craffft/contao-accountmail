Contao extension accountmail
============================

What is accountmail
-------------------
Accountmail sends emails to new members and users in contao. If a member or a user gets a new password, an email will also be sent.
In the backend, the email contents can be changed.

Hooks
-----
```
$GLOBALS['TL_HOOKS']['replaceAccountMailParameters'][] = array('Hooks', 'replaceAccountMailParameters');

/**
 * @param $strType
 * @param $arrParameters
 * @param $dc
 * @return array
 */
public function replaceAccountMailParameters($strType, $arrParameters, $dc)
{
    switch ($strType) {
        case 'emailNewMember':
            // Do anything
            break;

        case 'emailChangedMemberPassword':
            // Do anything
            break;

        case 'emailNewUser':
            // Do anything
            break;

        case 'emailChangedUserPassword':
            // Do anything
            break;
    }

    return $arrParameters;
}
```