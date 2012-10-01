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
require_once(t3lib_extMgm::extPath('pnf_cmdapi_cal') . 'opendata/datasource/tx_pnfcmdapical_sourceconnexion.php');

/**
 * @file class.tx_pnfcmdapical_tx_cal_category_datasource.php
 *
 * Short description of the command
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_cal
 */

class tx_pnfcmdapical_tx_cal_category_datasource
{
	// *************************
	// * User inclusions 0
	// * DO NOT DELETE OR CHANGE THOSE COMMENTS
	// *************************
	
	// ... (Add additional operations here) ...
	
	// * End user inclusions 0

	
	private $_datasourceDB = null;

	/**
	 * Constructor
	 *
	 */
	public function __construct()
	{
		$this->_datasourceDB = typo3db_connect();
		// *************************
		// * User inclusions constructor
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions constructor

	}

	/**
	 * Retrieves datasource's records
	 *
	 * @param	array	$queryarray	The query array to query on database
	 *
	 * @return	array	Array of records
	 */
	public function get($queryarray)
	{
		// *************************
		// * User inclusions get 0
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions get 0

		$rows = $this->_datasourceDB->exec_SELECTgetRows(
			$queryarray['fields'],
			$queryarray['fromtable'],
			$queryarray['where'],
			$queryarray['groupby'],
			$queryarray['order'],
			$queryarray['limit'],
			$queryarray['uidIndexField']
		);
		// *************************
		// * User inclusions get 1
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions get 1

		return $rows;
	} // End get

	/**
	 * Retrieves datasource's records
	 *
	 * @param	array	$params	The parameters to query on database
	 *
	 * @return	array	Array of records
	 */
	public function getTxcalcategorysAll($params)
	{
		// *************************
		// * User inclusions All 0
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions All 0

		$queryarray = array();
		$queryarray['fields'] = 
			'`tx_cal_category`.`uid` AS `id`, ' . 
			'`tx_cal_category`.`parent_category` AS `parent`, ' . 
			'`tx_cal_category`.`title` AS `title`';
		$queryarray['fromtable'] = 
			'`tx_cal_category`';
		$queryarray['where'] = 
			'1' . t3lib_BEfunc::deleteClause('tx_cal_category') . t3lib_BEfunc::BEenableFields('tx_cal_category');
		$queryarray['groupby'] = 
			'';
		$queryarray['order'] = 
			'';
		$queryarray['limit'] = 
			'';
		$queryarray['uidIndexField'] = 
			'';
		// *************************
		// * User inclusions All 1
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions All 1

		return $this->get($queryarray);
	} // End getTxcalcategorysAll

	// *************************
	// * User inclusions other processing
	// * DO NOT DELETE OR CHANGE THOSE COMMENTS
	// *************************
	
	// ... (Add additional operations here) ...
	
	// * End user inclusions other processing


} // End of class tx_pnfcmdapical_tx_cal_category_datasource

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_cal/opendata/datasource/class.tx_pnfcmdapical_tx_cal_category_datasource.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_cal/opendata/datasource/class.tx_pnfcmdapical_tx_cal_category_datasource.php']);
}
?>