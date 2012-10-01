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
 * @file class.tx_pnfcmdapiicsfd_fd_getcategories_command.php
 *
 * Short description of the class cal_getcategories
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_icsfd
 */


class tx_pnfcmdapiicsfd_fd_getcategories_command extends tx_icsodcoreapi_command
{
	var $params = array();

	// *************************
	// * User inclusions 0
	// * DO NOT DELETE OR CHANGE THOSE COMMENTS
	// *************************
	
	// ... (Add additional operations here) ...
	
	// * End user inclusions 0

	
	
	/**
	 * Executes the command.
	 *
	 * @param	array	$params The command parameters.
	 * @param	XMLWriter	$xmlwriter The XML Writer for output.
	 */
	function execute(array $params, XMLWriter $xmlwriter)
	{
		$params = array_merge($this->params, $params);
		
		// *************************
		// * User inclusions 1
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 1

		
		// Create a datasource object for retrieving fdcategories
		$datasource = t3lib_div::getUserObj($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pnf_cmdapi_icsfd']['datasource']['categories']);

		$fdcategories = array();
		
		$fdcategories = $datasource->getCategoriesAll($params);
		
		// *************************
		// * User inclusions 2
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 2

		
		$elements = $this->transformResultsForOutput($fdcategories);
		makeError($xmlwriter, SUCCESS_CODE, SUCCESS_TEXT);
		
		// *************************
		// * User inclusions 3
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 3

		
		$this->writeOutput($xmlwriter, $elements);
	}
	
	/**
	 * Transforms results for output
	 *
	 * @param	array	$fdcategories A collection of fdcategories
	 *
	 * @return	Elements array
	 */	
	protected function transformResultsForOutput(array $fdcategories)
	{
		// *************************
		// * User inclusions 4
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 4

		$elements = array();
		foreach ($fdcategories as $category)
		{
			$element = array();
			
			$element['id'] = (string)$category['id'];
			$element['title'] = $category['title'];

			// *************************
			// * User inclusions 5
			// * DO NOT DELETE OR CHANGE THOSE COMMENTS
			// *************************
			
			// ... (Add additional operations here) ...
			
			// * End user inclusions 5

			
			$elements[] = $element;
		}
		
		// *************************
		// * User inclusions 6
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 6

		
		return $elements;
	}
	
	/**
	 * Writes output
	 *
	 * @param	XMLWriter	$xmlwriter the writer
	 * @param	array	$elements
	 *
	 * @return void
	 */
	 protected function writeOutput(XMLWriter $xmlwriter, array $elements)
	{
		// *************************
		// * User inclusions 7
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 7

		$xmlwriter->startElement('data');
		// *************************
		// * User inclusions 8
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 8

		foreach ($elements as $element)
		{
			$xmlwriter->startElement('category');
			// *************************
			// * User inclusions 9
			// * DO NOT DELETE OR CHANGE THOSE COMMENTS
			// *************************
			
			// ... (Add additional operations here) ...
			
			// * End user inclusions 9

			foreach ($element as $key => $value)
			{
				// *************************
				// * User inclusions 10
				// * DO NOT DELETE OR CHANGE THOSE COMMENTS
				// *************************
				
				// ... (Add additional operations here) ...
				
				// * End user inclusions 10

				$xmlwriter->startElement($key);
				$xmlwriter->text($value);
				$xmlwriter->endElement();
				// *************************
				// * User inclusions 11
				// * DO NOT DELETE OR CHANGE THOSE COMMENTS
				// *************************
				
				// ... (Add additional operations here) ...
				
				// * End user inclusions 11

			}
			// *************************
			// * User inclusions 12
			// * DO NOT DELETE OR CHANGE THOSE COMMENTS
			// *************************
			
			// ... (Add additional operations here) ...
			
			// * End user inclusions 12

			$xmlwriter->endElement(); 
		}
		$xmlwriter->endElement();
	}
	
	// *************************
	// * User inclusions 13
	// * DO NOT DELETE OR CHANGE THOSE COMMENTS
	// *************************
	
	// ... (Add additional operations here) ...
	
	// * End user inclusions 13

	
} // End of class tx_pnfcmdapiicsfd_fd_getcategories_command

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_icsfd/opendata/class.tx_pnfcmdapiicsfd_fd_getcategories_command.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_icsfd/opendata/class.tx_pnfcmdapiicsfd_fd_getcategories_command.php']);
}

?>