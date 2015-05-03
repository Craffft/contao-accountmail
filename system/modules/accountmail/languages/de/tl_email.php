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
 * Title
 */
$GLOBALS['TL_LANG']['tl_email']['edit'] = 'Automatisierte E-Mails bearbeiten';

/**
 * Labels
 */
$GLOBALS['TL_LANG']['tl_email']['emailSender_legend'] = 'E-Mail Absender';
$GLOBALS['TL_LANG']['tl_email']['emailNewMember_legend'] = 'Neues Mitglied';
$GLOBALS['TL_LANG']['tl_email']['emailChangedMemberPassword_legend'] = 'Passwort bei Mitglied geändert';
$GLOBALS['TL_LANG']['tl_email']['emailNewUser_legend'] = 'Neuer Benutzer';
$GLOBALS['TL_LANG']['tl_email']['emailChangedUserPassword_legend'] = 'Passwort bei Benutzer geändert';

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_email']['emailFrom'] = array('Absender E-Mail Adresse', 'Bitte geben Sie die E-Mail Adresse des Absenders ein.');
$GLOBALS['TL_LANG']['tl_email']['emailFromName'] = array('Absender Name', 'Bitte geben Sie den Name des Absenders ein.');
$GLOBALS['TL_LANG']['tl_email']['emailSubject'] = array('Betreff', 'Bitte geben Sie den Betreff ein.');
$GLOBALS['TL_LANG']['tl_email']['emailTemplate'] = array('Template', 'Bitte wählen Sie das E-Mail Template aus.');
$GLOBALS['TL_LANG']['tl_email']['emailContent'] = array('Inhalt', 'Bitte geben Sie den Inhalt der E-Mail ein.');

/**
 * Helpwizard
 */
$GLOBALS['TL_LANG']['tl_email']['helpwizard'] = array('Allgemeine Beschreibung', 'Sie können in diesem Feld die Contao Insert-Tags und die, der Erweiterung "Inserttags" verwenden.<br><strong>WICHTIG: Jeder Insert-Tag muss das Flag "|refresh" haben</strong>, denn sonst kann es zu fehlerhaften E-Mails kommen.<br>Unter anderem können Sie auch die folgenden Platzhalter nutzen:');
