<?php

namespace Hfu\HfuOpus\Hooks\PageLayoutView;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Contains a preview rendering for the page module of CType="hfu_contentelements_spo"
 */
class PublistPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "My new content element"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     *
     * @return void
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    ) {
        if ($row['CType'] === 'hfu_opus_publist') {
            $itemContent .= '
            <table class="table table-condensed table-hover">
                <thead>
                    <tr><th colspan="2">' .
                LocalizationUtility::translate(
                    'ce_hfu_opus_publist.title',
                    'hfu_opus'
                ) . '</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>' .
                LocalizationUtility::translate(
                    'db_field_tt_content.tx_hfuopus_publistid',
                    'hfu_opus'
                )
                . '</td>
                        <td>' . $row['tx_hfuopus_publistid'] . '</td>
                    </tr>
                </tbody>
            </table>';

            $drawItem = false;
        }
    }
}
