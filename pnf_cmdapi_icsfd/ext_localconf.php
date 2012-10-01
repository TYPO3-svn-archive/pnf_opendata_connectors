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


// --- icsfd_getcategories
$TYPO3_CONF_VARS['EXTCONF']['ics_od_core_api']['command']['1.0']['fd_getcategories'] = 'EXT:pnf_cmdapi_icsfd/opendata/class.tx_pnfcmdapiicsfd_fd_getcategories_command.php:tx_pnfcmdapiicsfd_fd_getcategories_command';
$TYPO3_CONF_VARS['EXTCONF']['pnf_cmdapi_icsfd']['datasource']['categories'] = 'EXT:pnf_cmdapi_icsfd/opendata/datasource/class.tx_pnfcmdapiicsfd_tx_icsflexdirectory_categories_datasource.php:tx_pnfcmdapiicsfd_tx_icsflexdirectory_categories_datasource';
// --- icsfd_getsheets
$TYPO3_CONF_VARS['EXTCONF']['ics_od_core_api']['command']['1.0']['fd_getdirectories'] = 'EXT:pnf_cmdapi_icsfd/opendata/class.tx_pnfcmdapiicsfd_fd_getdirectories_command.php:tx_pnfcmdapiicsfd_fd_getdirectories_command';
$TYPO3_CONF_VARS['EXTCONF']['pnf_cmdapi_icsfd']['datasource']['directories'] = 'EXT:pnf_cmdapi_icsfd/opendata/datasource/class.tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource.php:tx_pnfcmdapiicsfd_tx_icsflexdirectory_sheets_datasource';


//--- API commands end---

// *************************
// * User inclusions 1
// * DO NOT DELETE OR CHANGE THOSE COMMENTS
// *************************

// ... (Add additional operations here) ...

// * End user inclusions 1