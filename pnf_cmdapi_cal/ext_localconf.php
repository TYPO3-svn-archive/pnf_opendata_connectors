<?php
/*
 * $Id: tx_icsopendata_template_ext_localconf.php 47386 2011-05-06 16:17:12Z mygoddess $
 */
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


// --- cal_getcategories
$TYPO3_CONF_VARS['EXTCONF']['ics_od_core_api']['command']['1.0']['cal_getcategories'] = 'EXT:pnf_cmdapi_cal/opendata/class.tx_pnfcmdapical_cal_getcategories_command.php:tx_pnfcmdapical_cal_getcategories_command';
$TYPO3_CONF_VARS['EXTCONF']['pnf_cmdapi_cal']['datasource']['txcalcategory'] = 'EXT:pnf_cmdapi_cal/opendata/datasource/class.tx_pnfcmdapical_tx_cal_category_datasource.php:tx_pnfcmdapical_tx_cal_category_datasource';
// --- cal_getevents
$TYPO3_CONF_VARS['EXTCONF']['ics_od_core_api']['command']['1.0']['cal_getevents'] = 'EXT:pnf_cmdapi_cal/opendata/class.tx_pnfcmdapical_cal_getevents_command.php:tx_pnfcmdapical_cal_getevents_command';
$TYPO3_CONF_VARS['EXTCONF']['pnf_cmdapi_cal']['datasource']['txcalevent'] = 'EXT:pnf_cmdapi_cal/opendata/datasource/class.tx_pnfcmdapical_tx_cal_event_datasource.php:tx_pnfcmdapical_tx_cal_event_datasource';


//--- API commands end---

// *************************
// * User inclusions 1
// * DO NOT DELETE OR CHANGE THOSE COMMENTS
// *************************

// ... (Add additional operations here) ...

// * End user inclusions 1