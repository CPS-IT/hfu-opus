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
     * @throws \TYPO3\CMS\Core\Exception
     */
    public function render($publistid)
    {
        $settings = $this->getSettings();
        $data = OPUS::fetchPubList($publistid, $settings['baseUrl']);

        // Parsing data
        $data = $this->parseData($data);

        return $data;
    }

    /**
     * Parsing data
     *
     * @param string $data
     * @return string
     */
    protected function parseData($data)
    {
        // Get current url
        $uriBuilder = $this->controllerContext->getUriBuilder();
        $currentUrl = $uriBuilder->buildFrontendUri();

        // Parse data (html code) - add current url to anchor links
        $data = $this->parseAnchorLinks($data, $currentUrl);

        return $data;
    }

    /**
     * Parsing anchor links - Add current url $currentUrl to anchor links within given data $data
     *
     * @param string $data
     * @param string $currentUrl
     * @return string
     */
    protected function parseAnchorLinks($data, $currentUrl)
    {
        if (preg_match_all('/(?<link><a[^>]*(?<attribute>href="(?<href>[^"]*)"[^>]*>))/is',
                $data, $matches)
            && isset($matches['link']) && !empty($matches['link'])
        ) {
            foreach ($matches['href'] as $matchKey => $matchLink) {
                if (substr(trim($matchLink), 0, 1) === '#' || strpos($matchLink, '#') !== false) {
                    $newLink = preg_replace('/' . $matchLink . '/', $currentUrl . $matchLink, $matches['link'][$matchKey]);
                    $data = str_replace($matches['link'][$matchKey], $newLink, $data);
                }
            }
        }

        return $data;
    }
}
