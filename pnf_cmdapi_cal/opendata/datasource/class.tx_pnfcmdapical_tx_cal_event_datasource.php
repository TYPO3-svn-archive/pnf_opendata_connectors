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
 * @file class.tx_pnfcmdapical_tx_cal_event_datasource.php
 *
 * Short description of the command
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_cal
 */

class tx_pnfcmdapical_tx_cal_event_datasource
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
	public function getTxcaleventsAll($params)
	{
		// *************************
		// * User inclusions All 0
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions All 0

		$queryarray = array();
		$queryarray['fields'] = 
			'`tx_cal_event`.`uid` AS `id`, ' . 
			'`tx_cal_event`.`crdate` AS `crdate`, ' . 
			'`tx_cal_event`.`start_date` AS `startdate`, ' . 
			'`tx_cal_event`.`end_date` AS `enddate`, ' . 
			'`tx_cal_event`.`start_time` AS `starttime`, ' . 
			'`tx_cal_event`.`end_time` AS `endtime`, ' . 
			'`tx_cal_event`.`title` AS `title`, ' . 
			'`tx_cal_event`.`category_id` AS `category`, ' . 
			'`tx_cal_event`.`teaser` AS `introduction`, ' . 
			'`tx_cal_event`.`description` AS `description`, ' . 
			'`tx_cal_event`.`type` AS `type`, ' . 
			'`tx_cal_event`.`page` AS `page`, ' .
			'`tx_cal_event`.`image` AS `image`';
		$queryarray['fromtable'] = 
			'`tx_cal_event`';
		$queryarray['where'] = 
			'1' . t3lib_BEfunc::deleteClause('tx_cal_event') . t3lib_BEfunc::BEenableFields('tx_cal_event');
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
		
		$queryarray['uidIndexField'] = 
			'id';
			
		$records = $this->get($queryarray);
		
		$this->processRecordsData($records);
		return $records;
		// * End user inclusions All 1

		return $this->get($queryarray);
	} // End getTxcaleventsAll

	// *************************
	// * User inclusions other processing
	// * DO NOT DELETE OR CHANGE THOSE COMMENTS
	// *************************
	
	// ... (Add additional operations here) ...
	
	/**
	 * Process records data
	 *
	 * @param	&array	$records: Records to process
	 * @return	void
	 */
	private function processRecordsData(&$records) 
	{
		t3lib_div::loadTCA('tx_cal_event');
		$image_path = t3lib_div::getIndpEnv('TYPO3_SITE_URL') . $GLOBALS['TCA']['tx_cal_event']['columns']['image']['config']['uploadfolder'] . '/';
		
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['pnf_cmdapi_cal']);
		
		$ids = array_keys($records);
		foreach ($ids as $id)
		{
			// Process startdate and enddate
			$records[$id]['startdate'] = mktime(0,0,0, substr($records[$id]['startdate'], 4, 2), substr($records[$id]['startdate'], 6, 2), substr($records[$id]['startdate'], 0, 4)) + $records[$id]['starttime'];
			$records[$id]['enddate'] = mktime(0,0,0, substr($records[$id]['enddate'], 4, 2), substr($records[$id]['enddate'], 6, 2), substr($records[$id]['enddate'], 0, 4)) + $records[$id]['endtime'];
		
			// Proccess image and gallery
			$images = t3lib_div::trimExplode(',', $records[$id]['image'], true);
			$records[$id]['image'] = count($images)? $image_path . $images[0]: null;
			$gallery = array();
			if (count($images)>1) 
			{
				for ($i=1; $i<count($images);$i++)
				{
					$gallery[] = $image_path . $images[$i];
				}
			}
			$records[$id]['gallery'] = count($gallery)? implode(',', $gallery): null;
			
			// Process categories
			$result = $this->_datasourceDB->exec_SELECT_mm_query(
				'uid_local, uid_foreign',
				'tx_cal_event',
				'tx_cal_event_category_mm',
				'tx_cal_category',
				' AND tx_cal_event_category_mm.uid_local='.$id,
				'',
				'tx_cal_event_category_mm.sorting ASC'
			);
			$categories = array();
			while ($row = $this->_datasourceDB->sql_fetch_assoc($result))
			{
				$categories[] = $row['uid_foreign'];
			}
			$this->_datasourceDB->sql_free_result($result);
			$records[$id]['category'] = implode(',', $categories);
			
			$categorySinglepid = null;
			if (count($categories>0))
			{
				$rows = $this->_datasourceDB->exec_SELECTgetRows(
					'single_pid',
					'tx_cal_category',
					'uid='.$categories[0],
					'',
					'',
					'1'
				);
				$categorySinglepid = $rows[0]['single_pid'];
			}
			
			// Process link
			$prefix = 'tx_cal_controller';
			$linkParams = array (
				'id' => 0,
				$prefix .'[uid]' => $id,
				$prefix . '[view]' => 'event',
				$prefix . '[type]' => 'tx_cal_phpicalendar',
			);
			$records[$id]['link'] = null;
			if ($extConf['singlePID'])
				$linkParams['id'] = $extConf['singlePID'];
			if ($records[$id]['type'] && $records[$id]['page'])
				$linkParams['id'] = $records[$id]['page'];
			if ($categorySinglepid) 
				$linkParams['id'] = $categorySinglepid;
			$records[$id]['link'] = t3lib_div::linkThisUrl(t3lib_div::getIndpEnv('TYPO3_SITE_URL'), $linkParams);
		}
	}
	// * End user inclusions other processing


} // End of class tx_pnfcmdapical_tx_cal_event_datasource

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_cal/opendata/datasource/class.tx_pnfcmdapical_tx_cal_event_datasource.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_cal/opendata/datasource/class.tx_pnfcmdapical_tx_cal_event_datasource.php']);
}
?>