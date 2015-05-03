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
$GLOBALS['TL_LANG']['tl_email']['edit'] = 'Edit automated emails';

/**
 * Labels
 */
$GLOBALS['TL_LANG']['tl_email']['emailSender_legend'] = 'Email sender';
$GLOBALS['TL_LANG']['tl_email']['emailNewMember_legend'] = 'New member';
$GLOBALS['TL_LANG']['tl_email']['emailChangedMemberPassword_legend'] = 'Password changed for member';
$GLOBALS['TL_LANG']['tl_email']['emailNewUser_legend'] = 'New user';
$GLOBALS['TL_LANG']['tl_email']['emailChangedUserPassword_legend'] = 'Password changed for user';

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_email']['emailFrom'] = array('Sender’s email address', 'Please enter the sender’s email address.');
$GLOBALS['TL_LANG']['tl_email']['emailFromName'] = array('Sender’s name', 'Please enter the sender’s name.');
$GLOBALS['TL_LANG']['tl_email']['emailSubject'] = array('Subject line', 'Please enter the subject here.');
$GLOBALS['TL_LANG']['tl_email']['emailTemplate'] = array('Template', 'Please select the email template.');
$GLOBALS['TL_LANG']['tl_email']['emailContent'] = array('Email content', 'Please enter the content of the email here.');

/**
 * Helpwizard
 */
$GLOBALS['TL_LANG']['tl_email']['helpwizard'] = array('General description', 'You can use in this field the Contao insert tags and the extension "insert tags".<br><strong>IMPORTANT: Each insert-tag must have the flag "| refresh"</strong>, because otherwise it could lead to erroneous emails.<br>Among other things, you can also use the following wildcards:');
