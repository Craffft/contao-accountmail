Contao extension accountmail
============================

What is accountmail
-------------------
Accountmail sends emails to new members and users in contao. If a member or a user gets a new password, an email will also be sent.
In the backend, the email contents can be changed.

License
-------

This Contao extension is licensed under the terms of the LGPLv3.
http://www.gnu.org/licenses/lgpl-3.0.html

Hooks
-----
```php
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
