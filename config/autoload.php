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

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'iCodr8',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Library
    'iCodr8\AccountMail\Account'        => 'system/modules/accountmail/library/iCodr8/AccountMail/Account.php',
    'iCodr8\AccountMail\Member\Account' => 'system/modules/accountmail/library/iCodr8/AccountMail/Member/Account.php',
    'iCodr8\AccountMail\User\Account'   => 'system/modules/accountmail/library/iCodr8/AccountMail/User/Account.php',
    'iCodr8\AccountMail\Email'          => 'system/modules/accountmail/library/iCodr8/AccountMail/Email.php',
));
