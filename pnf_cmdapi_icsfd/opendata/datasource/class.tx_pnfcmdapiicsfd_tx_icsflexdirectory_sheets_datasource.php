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
require_once(t3lib_extMgm::extPath('pnf_cmdapi_icsfd') . 'opendata/datasource/tx_pnfcmdapiicsfd_sourceconnexion.php');
require_once(t3lib_extMgm::extPath('ics_fd_feformbuilder') . 'lib/class.fd_sheet.php');
/**
 * @file class.tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource.php
 *
 * Short description of the command
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_icsfd
 */

class tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource
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
	public function getDirectoriesAll($params)
	{
		// *************************
		// * User inclusions All 0
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		$GLOBALS['BE_USER'] = true;
		$builderGenerator = t3lib_div::makeInstance('tx_icsfdfeformbuilder_class_generator');
		$builderGenerator->buildFiles();
		// * End user inclusions All 0

		$queryarray = array();
		$queryarray['fields'] = 
			'`tx_icsflexdirectory_sheets`.* ';
		$queryarray['fromtable'] = 
			'`tx_icsflexdirectory_sheets`';
		$queryarray['where'] = 
			'1' . t3lib_BEfunc::deleteClause('tx_icsflexdirectory_sheets') . t3lib_BEfunc::BEenableFields('tx_icsflexdirectory_sheets');
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
			'uid';
			
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
		// Path corresponds ics_flexdirectory/mod1/class.tx_icsflexdirectory_flexforms.php, function makeFieldTCA file's path
		$image_path = 'uploads/tx_icsflexdirectory/';
		
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['pnf_cmdapi_icsfd']);

		foreach ($records as $id => $record)
		{
			$sheet = FdSheet::fromDatabase($record);
			$sheetCategory = $sheet->getCategory();
			// var_dump($sheetCategory );
			// Retrieves description
			if (method_exists($sheetCategory, 'getDescription'))
			{
				$records[$id]['description'] = $sheetCategory->getDescription();
			}
			// Retrieves adresse
			if (method_exists($sheetCategory, 'getAdresse'))
			{
				$records[$id]['address'] = $sheetCategory->getAdresse();
			}
			// Retrieves position
			if (method_exists($sheetCategory, 'getGeolocalisation'))
			{
				$position = t3lib_div::trimExplode(',', $sheetCategory->getGeolocalisation(), true);
				$records[$id]['latitude'] = $position[0];
				$records[$id]['longitude']  = $position[1];
			}
			// Retrieves image and gallery
			if (method_exists($sheetCategory, 'getImageCount') && method_exists($sheetCategory, 'getImage'))
			{
				$imgCount = $sheetCategory->getImageCount();
				$records[$id]['image'] = $imgCount? $image_path . $sheetCategory->getImage(0): null;
				$gallery = array();
				if ($imgCount>1) {
					for ($i=1; $i<$imgCount; $i++)
					{
						$gallery[] =  $image_path . $sheetCategory->getImage($i);
					}
				}
				$records[$id]['gallery'] = count($gallery)? implode(',', $gallery): null;
			}
			// Retrieves link
			$records[$id]['link'] = $extConf['singlePID']? t3lib_div::linkThisUrl(t3lib_div::getIndpEnv('TYPO3_SITE_URL'), array('id'=>$extConf['singlePID'], 'tx_icsflexdirectory_pi1[uid]'=>$id)): null;
			$records[$id]['id'] = $record['uid'];unset($records[$id]['uid']);
			$records[$id]['title'] = $record['name'];unset($records[$id]['name']);
		}
	}
	// * End user inclusions other processing


} // End of class tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_icsfd/opendata/datasource/class.tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_icsfd/opendata/datasource/class.tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource.php']);
}
?>