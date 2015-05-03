<?php

/**
 * Extension for Contao Open Source CMS
 *
 * Copyright (c) 2014-2015 Daniel Kiesel
 *
 * @package AccountMail
 * @link    https://github.com/craffft/contao-accountmail
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Craffft\AccountMail;

class AccountMailRunonce extends \System
{
    public function __construct()
    {
        parent::__construct();

        // Disable debug mode
        $GLOBALS['TL_CONFIG']['debugMode'] = false;

        // Load required classes
        \ClassLoader::addNamespace('Craffft');
        \ClassLoader::addClass('Craffft\AccountMail\Updater', 'system/modules/accountmail/library/Craffft/AccountMail/Updater.php');
        \ClassLoader::register();

        // Load updater
        $this->import('\Craffft\AccountMail\Updater', 'Updater');
    }

    public function run()
    {
        $this->Updater->addDefaultEmailContents();
    }
}

/**
 * Instantiate controller
 */
$objAccountMailRunonce = new AccountMailRunonce();
$objAccountMailRunonce->run();
