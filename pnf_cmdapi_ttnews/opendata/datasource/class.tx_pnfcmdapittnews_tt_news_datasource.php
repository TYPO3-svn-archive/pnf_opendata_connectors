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
require_once(t3lib_extMgm::extPath('pnf_cmdapi_ttnews') . 'opendata/datasource/tx_pnfcmdapittnews_sourceconnexion.php');

/**
 * @file class.tx_pnfcmdapittnews_tt_news_datasource.php
 *
 * Short description of the command
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_ttnews
 */

class tx_pnfcmdapittnews_tt_news_datasource
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
	public function getTtnewssAll($params)
	{
		// *************************
		// * User inclusions All 0
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions All 0

		$queryarray = array();
		$queryarray['fields'] = 
			'`tt_news`.`uid` AS `id`, ' . 
			'`tt_news`.`crdate` AS `crdate`, ' . 
			'`tt_news`.`title` AS `title`, ' . 
			'`tt_news`.`image` AS `image`, ' . 
			'`tt_news`.`short` AS `introduction`, ' . 
			'`tt_news`.`bodytext` AS `description`, ' . 
			'`tt_news`.`category` AS `category`, ' . 
			'`tt_news`.`type` AS `type`, ' . 
			'`tt_news`.`page` AS `page`';
		$queryarray['fromtable'] = 
			'`tt_news`';
		$queryarray['where'] = 
			'1' . t3lib_BEfunc::deleteClause('tt_news') . t3lib_BEfunc::BEenableFields('tt_news');
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
	} // End getTtnewssAll

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
		t3lib_div::loadTCA('tt_news');
		$image_path = t3lib_div::getIndpEnv('TYPO3_SITE_URL') . $GLOBALS['TCA']['tt_news']['columns']['image']['config']['uploadfolder'] . '/';
		
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['pnf_cmdapi_ttnews']);
		
		$ids = array_keys($records);
		foreach ($ids as $id)
		{
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
				'tt_news',
				'tt_news_cat_mm',
				'tt_news_cat',
				' AND uid_local='.$id,
				'',
				'tt_news_cat_mm.sorting ASC'
			);
			$categories = array();
			while ($row = $this->_datasourceDB->sql_fetch_assoc($result))
			{
				$categories[] = $row['uid_foreign'];
			}
			$this->_datasourceDB->sql_free_result($result);
			$records[$id]['category'] = implode(',', $categories);
			
			// Process link
			$records[$id]['link'] = $extConf['singlePID']? t3lib_div::linkThisUrl(t3lib_div::getIndpEnv('TYPO3_SITE_URL'), array('id'=>$extConf['singlePID'], 'tx_ttnews[tt_news]'=>$id)): null;
			$records[$id]['link'] = ($records[$id]['type'] && $records[$id]['page'])? t3lib_div::linkThisUrl(t3lib_div::getIndpEnv('TYPO3_SITE_URL'), array('id'=>$records[$id]['page'], 'tx_ttnews[tt_news]'=>$id)): $records[$id]['link'];
			
			// Process categories
			
		}
	}
	// * End user inclusions other processing


} // End of class tx_pnfcmdapittnews_tt_news_datasource


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_ttnews/opendata/datasource/class.tx_pnfcmdapittnews_tt_news_datasource.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_ttnews/opendata/datasource/class.tx_pnfcmdapittnews_tt_news_datasource.php']);
}
?>