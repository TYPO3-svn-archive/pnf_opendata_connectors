<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
// *************************
// * User inclusions 0
// * DO NOT DELETE OR CHANGE THOSE COMMENTS
// *************************

// ... (Add additional operations here) ...

// * End user inclusions 0


//--- API commands start---


// --- ttnews_getcategories
$TYPO3_CONF_VARS['EXTCONF']['ics_od_core_api']['command']['1.0']['ttnews_getcategories'] = 'EXT:pnf_cmdapi_ttnews/opendata/class.tx_pnfcmdapittnews_ttnews_getcategories_command.php:tx_pnfcmdapittnews_ttnews_getcategories_command';
$TYPO3_CONF_VARS['EXTCONF']['pnf_cmdapi_ttnews']['datasource']['ttnewscat'] = 'EXT:pnf_cmdapi_ttnews/opendata/datasource/class.tx_pnfcmdapittnews_tt_news_cat_datasource.php:tx_pnfcmdapittnews_tt_news_cat_datasource';
// --- ttnews_getnews
$TYPO3_CONF_VARS['EXTCONF']['ics_od_core_api']['command']['1.0']['ttnews_getnews'] = 'EXT:pnf_cmdapi_ttnews/opendata/class.tx_pnfcmdapittnews_ttnews_getnews_command.php:tx_pnfcmdapittnews_ttnews_getnews_command';
$TYPO3_CONF_VARS['EXTCONF']['pnf_cmdapi_ttnews']['datasource']['ttnews'] = 'EXT:pnf_cmdapi_ttnews/opendata/datasource/class.tx_pnfcmdapittnews_tt_news_datasource.php:tx_pnfcmdapittnews_tt_news_datasource';


//--- API commands end---

// *************************
// * User inclusions 1
// * DO NOT DELETE OR CHANGE THOSE COMMENTS
// *************************

// ... (Add additional operations here) ...

// * End user inclusions 1
