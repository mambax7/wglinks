<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wglinks module for xoops
 *
 * @copyright module for xoops
 * @license   GPL 2.0 or later
 * @package   wglinks
 * @since     1.0
 * @min_xoops 2.5.7
 */

$moduleDirName      = basename(dirname(__DIR__, 2));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

//Sample Data
define('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA', 'Import Sample Data (will delete ALL current data)');
define('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS', 'Sample Date uploaded successfully');
define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA', 'Export Tables to YAML');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON', 'Show Sample Button?');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC', 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.');
define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA', 'Export DB Schema to YAML');
define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_SUCCESS', 'Export DB Schema to YAML was a success');
define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_ERROR', 'ERROR: Export of DB Schema to YAML failed');

//Menu
define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_MIGRATE', 'Migrate');
define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_YES', 'Folder "%s" exist');
define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_NO', 'Folder "%s" does not exist. Create the specified folder with CHMOD 777.');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS', 'Show Development Tools Button?');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC', 'If yes, the "Migrate" Tab and other Development tools will be visible to the Admin.');
define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_FEEDBACK', 'Feedback');

//Latest Version Check
define('CO_' . $moduleDirNameUpper . '_' . 'NEW_VERSION', 'New Version: ');
define('CO_' . $moduleDirNameUpper . '_' . 'ERROR_BAD_XOOPS', 'You need minimul version %s (your current version is %s)');
