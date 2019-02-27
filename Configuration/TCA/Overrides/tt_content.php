<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:hfu_opus/Resources/Private/Language/locallang.xlf:ce_hfu_opus_publist.title',
        'hfu_opus_publist',
        'apps-clipboard-list',
    ),
    'CType',
    'hfu_opus'
);

// Configure required database fields
$tx_hfuopus_fields = array(
    'tx_hfuopus_publistid' => array(
        'label' => 'LLL:EXT:hfu_opus/Resources/Private/Language/locallang.xlf:db_field_tt_content.tx_hfuopus_publistid',
        'exclude' => 1,
        'config' => array(
            'type' => 'input',
            'eval' => 'trim',
        ),
        'l10n_mode' => 'exclude',
    ),
);

// Add required fields to tt_content
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $tx_hfuopus_fields
);

// Configure palette for opus
// Konfiguation Palette für OPUS-Publikationsliste
$GLOBALS['TCA']['tt_content']['palettes']['tx_hfuopus_publist'] = array(
    'showitem' => 'tx_hfuopus_publistid',
    'canNotCollapse' => 1,
);

// Configure content element
$GLOBALS['TCA']['tt_content']['types']['hfu_opus_publist'] = array(
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --palette--;LLL:EXT:hfu_opus/Resources/Private/Language/locallang.xlf:tca_palette_title.hfu_opus_publist;tx_hfuopus_publist,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access',
);
