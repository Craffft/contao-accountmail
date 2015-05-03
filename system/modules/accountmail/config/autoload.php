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

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Craffft',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Library
    'Craffft\AccountMail\Account'        => 'system/modules/accountmail/library/Craffft/AccountMail/Account.php',
    'Craffft\AccountMail\Email'          => 'system/modules/accountmail/library/Craffft/AccountMail/Email.php',
    'Craffft\AccountMail\Helpwizard'     => 'system/modules/accountmail/library/Craffft/AccountMail/Helpwizard.php',
    'Craffft\AccountMail\InsertTags'     => 'system/modules/accountmail/library/Craffft/AccountMail/InsertTags.php',
    'Craffft\AccountMail\Member\Account' => 'system/modules/accountmail/library/Craffft/AccountMail/Member/Account.php',
    'Craffft\AccountMail\Updater'        => 'system/modules/accountmail/library/Craffft/AccountMail/Updater.php',
    'Craffft\AccountMail\User\Account'   => 'system/modules/accountmail/library/Craffft/AccountMail/User/Account.php',
));
