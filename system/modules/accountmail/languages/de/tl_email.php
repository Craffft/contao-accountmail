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
 * Parameters
 */
$GLOBALS['TL_LANG']['tl_email']['parameters']['name'] = array('{{name}}', 'Nutzen Sie diesen Platzhalter, um den Name in die E-Mail einzufügen.');
$GLOBALS['TL_LANG']['tl_email']['parameters']['firstname'] = array('{{firstname}}', 'Nutzen Sie diesen Platzhalter, um den Vorname in die E-Mail einzufügen.');
$GLOBALS['TL_LANG']['tl_email']['parameters']['lastname'] = array('{{lastname}}', 'Nutzen Sie diesen Platzhalter, um den Nachname in die E-Mail einzufügen.');
$GLOBALS['TL_LANG']['tl_email']['parameters']['email'] = array('{{email}}', 'Nutzen Sie diesen Platzhalter, um die E-Mail Adresse in die E-Mail einzufügen.');
$GLOBALS['TL_LANG']['tl_email']['parameters']['username'] = array('{{username}}', 'Nutzen Sie diesen Platzhalter, um den Benutzername in die E-Mail einzufügen.');
$GLOBALS['TL_LANG']['tl_email']['parameters']['password'] = array('{{password}}', 'Nutzen Sie diesen Platzhalter, um das Passwort in die E-Mail einzufügen.');
