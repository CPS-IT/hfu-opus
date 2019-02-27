<?php

namespace Hfu\HfuOpus\ViewHelpers;

use Hfu\HfuOpus\Utility\OpusApi as OPUS;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class PublistViewHelper
 *
 * @package Hfu\HfuOpus\ViewHelpers
 */
class PublistViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Returns TypoSript settings array
     *
     * @return array
     */
    private function getSettings()
    {
        $configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

        $typoScript = $configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );

        $settings = $typoScript['plugin.']['tx_hfu_opus.']['settings.'];

        return $settings;
    }

    /**
     * @param string $publistid
     * @return mixed|string
     */
    public function render($publistid)
    {
        $settings = $this->getSettings();

        return OPUS::fetchPubList($publistid, $settings['baseUrl']);
    }
}
