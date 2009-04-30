<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005-2009
 * @author     Leo Feyer <leo@typolight.org>
 * @package    Newsletter
 * @license    LGPL
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_newsletter']['subject']       = array('Subject', 'Please enter the newsletter subject.');
$GLOBALS['TL_LANG']['tl_newsletter']['alias']         = array('Newsletter alias', 'The newsletter alias is a unique reference to the newsletter which can be called instead of its numeric ID.');
$GLOBALS['TL_LANG']['tl_newsletter']['content']       = array('HTML content', 'Here you can enter the HTML content of the newsletter. Use the wildcard <em>##email##</em> to insert the recipient\'s e-mail address.');
$GLOBALS['TL_LANG']['tl_newsletter']['text']          = array('Text content', 'Here you can enter the text content of the newsletter. Use the wildcard <em>##email##</em> to insert the recipient\'s e-mail address.');
$GLOBALS['TL_LANG']['tl_newsletter']['addFile']       = array('Add attachments', 'Attach one or more files to the newsletter.');
$GLOBALS['TL_LANG']['tl_newsletter']['files']         = array('Attachments', 'Please choose the files to be attached from the files directory.');
$GLOBALS['TL_LANG']['tl_newsletter']['template']      = array('E-mail template', 'Here you can choose the e-mail template.');
$GLOBALS['TL_LANG']['tl_newsletter']['sendText']      = array('Send as plain text', 'Send the newsletter as plain text e-mail without the HTML content.');
$GLOBALS['TL_LANG']['tl_newsletter']['senderName']    = array('Sender name', 'Here you can enter the sender\'s name.');
$GLOBALS['TL_LANG']['tl_newsletter']['sender']        = array('Sender address', 'Here you can enter a custom sender address.');
$GLOBALS['TL_LANG']['tl_newsletter']['sendPreviewTo'] = array('Send preview to', 'Send the preview of the newsletter to this e-mail address.');
$GLOBALS['TL_LANG']['tl_newsletter']['mailsPerCycle'] = array('Mails per cycle', 'The sending process is split into several cycles to prevent the script from timing out.');
$GLOBALS['TL_LANG']['tl_newsletter']['timeout']       = array('Timeout in seconds', 'Here you can modify the waiting time between each cycle to control the number of e-mails per minute.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_newsletter']['title_legend']      = 'Title and subject';
$GLOBALS['TL_LANG']['tl_newsletter']['html_legend']       = 'HTML content';
$GLOBALS['TL_LANG']['tl_newsletter']['text_legend']       = 'Text content';
$GLOBALS['TL_LANG']['tl_newsletter']['attachment_legend'] = 'Attachments';
$GLOBALS['TL_LANG']['tl_newsletter']['template_legend']   = 'Template settings';
$GLOBALS['TL_LANG']['tl_newsletter']['expert_legend']     = 'Expert settings';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_newsletter']['sent']        = 'Sent';
$GLOBALS['TL_LANG']['tl_newsletter']['sentOn']      = 'Sent on %s';
$GLOBALS['TL_LANG']['tl_newsletter']['notSent']     = 'Not sent yet';
$GLOBALS['TL_LANG']['tl_newsletter']['mailingDate'] = 'Mailing date';
$GLOBALS['TL_LANG']['tl_newsletter']['headline']    = 'Send newsletter';
$GLOBALS['TL_LANG']['tl_newsletter']['confirm']     = 'The newsletter has been sent to %s recipients.';
$GLOBALS['TL_LANG']['tl_newsletter']['error']       = 'There are no active subscribers to the channel.';
$GLOBALS['TL_LANG']['tl_newsletter']['from']        = 'From';
$GLOBALS['TL_LANG']['tl_newsletter']['attachments'] = 'Attachments';
$GLOBALS['TL_LANG']['tl_newsletter']['preview']     = 'Send preview';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_newsletter']['new']        = array('New newsletter', 'Create a new newsletter');
$GLOBALS['TL_LANG']['tl_newsletter']['show']       = array('Newsletter details', 'Show the details of newsletter ID %s');
$GLOBALS['TL_LANG']['tl_newsletter']['edit']       = array('Edit newsletter', 'Edit newsletter ID %s');
$GLOBALS['TL_LANG']['tl_newsletter']['copy']       = array('Copy newsletter', 'Copy newsletter ID %s');
$GLOBALS['TL_LANG']['tl_newsletter']['cut']        = array('Move newsletter', 'Move newsletter ID %s');
$GLOBALS['TL_LANG']['tl_newsletter']['delete']     = array('Delete newsletter', 'Delete newsletter ID %s');
$GLOBALS['TL_LANG']['tl_newsletter']['editheader'] = array('Edit channel', 'Edit the channel settings');
$GLOBALS['TL_LANG']['tl_newsletter']['send']       = array('Send newsletter', 'Send newsletter ID %s');

?>