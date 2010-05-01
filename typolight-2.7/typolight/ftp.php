<?php

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
 * @package    Backend
 * @license    LGPL
 * @filesource
 */


/**
 * Initialize the system
 */
define('TL_MODE', 'BE');
require_once('../system/initialize.php');


/**
 * Show error messages
 */
@ini_set('display_errors', 1);
@error_reporting(1);


/**
 * Class FtpCheck
 *
 * Back end FTP check.
 * @copyright  Leo Feyer 2005-2009
 * @author     Leo Feyer <leo@typolight.org>
 * @package    Controller
 */
class FtpCheck extends Controller
{

	/**
	 * Initialize the controller
	 */
	public function __construct()
	{
		parent::__construct();

		$GLOBALS['TL_LANGUAGE'] = 'en';
		$GLOBALS['TL_CONFIG']['showHelp'] = false;
		$GLOBALS['TL_CONFIG']['displayErrors'] = true;
	}


	/**
	 * Run controller and parse the login template
	 */
	public function run()
	{
		$this->Template = new BackendTemplate('be_ftp');


		/**
		 * Lock the tool if there are too many login attempts
		 */
		if ($GLOBALS['TL_CONFIG']['installCount'] >= 3)
		{
			$this->Template->locked = true;
			$this->outputAndExit();
		}


		/**
		 * Authenticate user
		 */
		if ($this->Input->post('FORM_SUBMIT') == 'tl_login')
		{
			$_SESSION['TL_INSTALL_AUTH'] = '';
			$_SESSION['TL_INSTALL_EXPIRE'] = 0;

			list($strPassword, $strSalt) = explode(':', $GLOBALS['TL_CONFIG']['installPassword']);

			// Password is correct but not yet salted
			if (!strlen($strSalt) && $strPassword == sha1($this->Input->post('password')))
			{
				$strSalt = substr(md5(uniqid('', true)), 0, 23);
				$strPassword = sha1($strSalt . $this->Input->post('password'));
				$this->Config->update("\$GLOBALS['TL_CONFIG']['installPassword']", $strPassword . ':' . $strSalt);
			}

			// Set cookie
			if (strlen($strSalt) && $strPassword == sha1($strSalt . $this->Input->post('password')))
			{
				$_SESSION['TL_INSTALL_EXPIRE'] = (time() + 300);
				$_SESSION['TL_INSTALL_AUTH'] = md5(uniqid('', true) . (!$GLOBALS['TL_CONFIG']['disableIpCheck'] ? $this->Environment->ip : '') . session_id());

				$this->setCookie('TL_INSTALL_AUTH', $_SESSION['TL_INSTALL_AUTH'], $_SESSION['TL_INSTALL_EXPIRE'], $GLOBALS['TL_CONFIG']['websitePath']);
				$this->Config->update("\$GLOBALS['TL_CONFIG']['installCount']", 0);

				$this->reload();
			}

			// Increase count
			$this->Config->update("\$GLOBALS['TL_CONFIG']['installCount']", $GLOBALS['TL_CONFIG']['installCount'] + 1);
			$this->Template->passwordError = 'Invalid password!';
		}

		// Check cookie
		if (!$this->Input->cookie('TL_INSTALL_AUTH') || $_SESSION['TL_INSTALL_AUTH'] == '' || $this->Input->cookie('TL_INSTALL_AUTH') != $_SESSION['TL_INSTALL_AUTH'] || $_SESSION['TL_INSTALL_EXPIRE'] < time())
		{
			$this->Template->login = true;
			$this->outputAndExit();
		}

		// Renew cookie
		else
		{
			$_SESSION['TL_INSTALL_EXPIRE'] = (time() + 300);
			$_SESSION['TL_INSTALL_AUTH'] = md5(uniqid('', true) . (!$GLOBALS['TL_CONFIG']['disableIpCheck'] ? $this->Environment->ip : '') . session_id());

			$this->setCookie('TL_INSTALL_AUTH', $_SESSION['TL_INSTALL_AUTH'], $_SESSION['TL_INSTALL_EXPIRE'], $GLOBALS['TL_CONFIG']['websitePath']);
		}


		/**
		 * Check FTP credentials
		 */
		$this->Template->ftpHost = $GLOBALS['TL_CONFIG']['ftpHost'];
		$this->Template->ftpUser = $GLOBALS['TL_CONFIG']['ftpUser'];
		$this->Template->ftpPath = $GLOBALS['TL_CONFIG']['ftpPath'];

		// Check if enabled
		if (!$GLOBALS['TL_CONFIG']['useFTP'])
		{
			$this->Template->ftpDisabled = true;
			$this->outputAndExit();
		}

		$this->Template->ftpHostError = true;
		$this->Template->ftpUserError = true;
		$this->Template->ftpPathError = true;

		// Connect to host
		if (($resFtp = ftp_connect($GLOBALS['TL_CONFIG']['ftpHost'])) == false)
		{
			$this->outputAndExit();
		}

		$this->Template->ftpHostError = false;

		// Log in
		if (!ftp_login($resFtp, $GLOBALS['TL_CONFIG']['ftpUser'], $GLOBALS['TL_CONFIG']['ftpPass']))
		{
			$this->outputAndExit();
		}

		$this->Template->ftpUserError = false;

		// Change to TYPOlight directory
		if (!ftp_chdir($resFtp, $GLOBALS['TL_CONFIG']['ftpPath']))
		{
			$this->outputAndExit();
		}

		$this->Template->ftpPathError = false;


		/**
		 * Output the template file
		 */
		$this->outputAndExit();
	}


	/**
	 * Output the template file and exit
	 */
	protected function outputAndExit()
	{
		$this->Template->theme = $this->getTheme();
		$this->Template->base = $this->Environment->base;
		$this->Template->language = $GLOBALS['TL_LANGUAGE'];
		$this->Template->charset = $GLOBALS['TL_CONFIG']['characterSet'];
		$this->Template->isMac = preg_match('/mac/i', $this->Environment->httpUserAgent);
		$this->Template->pageOffset = $this->Input->cookie('BE_PAGE_OFFSET');
		$this->Template->action = ampersand($this->Environment->request);

		$this->Template->output();
		exit;
	}
}


/**
 * Instantiate controller
 */
$objFtpCheck = new FtpCheck();
$objFtpCheck->run();

?>