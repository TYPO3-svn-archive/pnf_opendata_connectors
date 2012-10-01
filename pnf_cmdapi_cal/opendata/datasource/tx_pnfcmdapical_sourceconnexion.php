<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Plan.Net <technique@in-cite.net>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * @file tx_pnfcmdapical_sourceconnexion.php
 *
 * Connexion functions to datasource
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_cal
 */


/**
 * Connect to the datasource typo3db
 *
 * @return	object	The connexion to the datasource
 */
function typo3db_connect()
{
	// *************************
	// * User inclusions typo3db_connect
	// * DO NOT DELETE OR CHANGE THOSE COMMENTS
	// *************************
	
	// ... (Add additional operations here) ...
	
	// * End user inclusions typo3db_connect


	return $GLOBALS['TYPO3_DB'];
}

