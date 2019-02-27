<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'OPUS Integration',
    'description' => 'Integration von OPUS Publikationslisten.',
    'category' => 'plugin',
    'author' => 'Thomas Keller',
    'author_email' => 'thomas.keller@hs-furtwangen.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6-8.7.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
);
