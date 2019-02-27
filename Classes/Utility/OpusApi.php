<?php

namespace Hfu\HfuOpus\Utility;

/**
 * Class OpusApi
 *
 * @package Hfu\HfuOpus\Utility
 */
class OpusApi
{

    /**
     * @param $opusKey
     * @param $opusUrl
     * @return mixed|string
     */
    public static function fetchPubList($opusKey, $opusUrl)
    {

        // Kein Schlüssel wurde hinterlegt.
        if (empty($opusKey)) {
            return $opusKey;
        }

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_MAXREDIRS => 10,
        );
        $ch = curl_init($opusUrl . $opusKey);
        curl_setopt_array($ch, $options);
        $data = curl_exec($ch);
        $errno = curl_errno($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $data;
    }
}
