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
 * @file class.tx_pnfcmdapittnews_ttnews_getnews_command.php
 *
 * Short description of the class ttnews_getcategories
 * 
 * @author    Plan.Net <technique@in-cite.net>
 * @package    TYPO3.pnf_cmdapi_ttnews
 */
class tx_pnfcmdapittnews_ttnews_getnews_command extends tx_icsodcoreapi_command
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

		
		// Create a datasource object for retrieving ttnewss
		$datasource = t3lib_div::getUserObj($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pnf_cmdapi_ttnews']['datasource']['ttnews']);
		
		$ttnewss = array();
		
		$ttnewss = $datasource->getTtnewssAll($params);
		
		// *************************
		// * User inclusions 2
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 2

		
		$elements = $this->transformResultsForOutput($ttnewss);
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
	 * @param	array	$ttnewss A collection of ttnewss
	 *
	 * @return	Elements array
	 */	
	protected function transformResultsForOutput(array $ttnewss)
	{
		// *************************
		// * User inclusions 4
		// * DO NOT DELETE OR CHANGE THOSE COMMENTS
		// *************************
		
		// ... (Add additional operations here) ...
		
		// * End user inclusions 4

		$elements = array();
		foreach ($ttnewss as $ttnews)
		{
			$element = array();

			$element['id'] = (string)$ttnews['id'];
			$element['crdate'] = (string)$ttnews['crdate'];
			$element['title'] = $ttnews['title'];
			$element['image'] = $ttnews['image'];
			$element['gallery'] = null;
			$element['introduction'] = $ttnews['introduction'];
			$element['description'] = $ttnews['description'];
			$element['category'] = (string)$ttnews['category'];
			$element['type'] = (string)$ttnews['type'];
			$element['page'] = (string)$ttnews['page'];
			

			// *************************
			// * User inclusions 5
			// * DO NOT DELETE OR CHANGE THOSE COMMENTS
			// *************************
			
			// ... (Add additional operations here) ...

			$element['crdate'] = date('Y-m-d H:i:s', $ttnews['crdate']);
			$element['image'] =  $ttnews['image'];	// Image's url
			$element['gallery'] =  $ttnews['gallery'];	// List of images urls
			$element['link'] = $ttnews['link'];
			
			unset($element['type']);
			unset($element['page']);
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
			$xmlwriter->startElement('news');
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
				switch ($key)
				{
					case 'image':
					case 'gallery':
						$this->writeOutputLink($xmlwriter, $key, t3lib_div::trimExplode(',', $value, true));
						break;
					case 'category':
						$this->writeOutputCategories($xmlwriter, t3lib_div::trimExplode(',', $value, true));
						break;
					default:
				// * End user inclusions 10

				$xmlwriter->startElement($key);
				$xmlwriter->text($value);
				$xmlwriter->endElement();
				// *************************
				// * User inclusions 11
				// * DO NOT DELETE OR CHANGE THOSE COMMENTS
				// *************************
				
				// ... (Add additional operations here) ...
				}
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
	
	/**
	 * Writes output for links
	 *
	 * @param	XMLWriter	$xmlwriter the writer
	 * @param	string		$elname: Element's name
	 * @param	array		$link: Array of links
	 *
	 * @return void
	 *
	 */
	private function writeOutputLink(XMLWriter $xmlwriter, $elname, array $links) 
	{
		$xmlwriter->startElement($elname);
		foreach ($links as $link)
		{
			$xmlwriter->startElement('url');
			$xmlwriter->text($link);	
			$xmlwriter->endElement();
		}
		$xmlwriter->endElement();		
	}
	/**
	 * Writes output categories
	 *
	 * @param	XMLWriter	$xmlwriter the writer
	 * @param	array		$categories: Array of categories
	 *
	 * @return void
	 *
	 */
	private function writeOutputCategories(XMLWriter $xmlwriter, array $categories) 
	{
		$elname = 'categories';
		$xmlwriter->startElement($elname);
		foreach ($categories as $category)
		{
			$xmlwriter->startElement('category');
			$xmlwriter->text($category);	
			$xmlwriter->endElement();
		}
		$xmlwriter->endElement();
		
	}	
	// * End user inclusions 13

	
} // End of class tx_pnfcmdapittnews_ttnews_getnews_command

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_ttnews/opendata/class.tx_pnfcmdapittnews_ttnews_getnews_command.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pnf_cmdapi_ttnews/opendata/class.tx_pnfcmdapittnews_ttnews_getnews_command.php']);
}
?>