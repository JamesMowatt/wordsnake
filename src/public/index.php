<?php

require_once('vendor/autoload.php');

$words = [
    'Snakes',
    'Slither',
    'really',
    'yesterday'
];

$wordsToBuild = cleanArray($words);

$wordGrid = [];

foreach ($wordsToBuild as $key => $word) {
    if ($key == 0) {
        $endX = strlen($word) - 1;
        $wordGrid[$key] = ['word' => $word, 'startX' => 0, 'startY' => 0, 'endX' => $endX, 'endY' => 0];
        continue;
    }

    switch (calculateWordOrientation(
        $wordGrid[$key - 1]['startX'],
        $wordGrid[$key - 1]['endX'],
        $wordGrid[$key - 1]['startY'],
        $wordGrid[$key - 1]['endY']
    )) {
        case 'h':
            $wordGrid[$key] = [
                'word' => $word,
                'startX' => $wordGrid[$key - 1]['endX'],
                'startY' => $wordGrid[$key - 1]['endY'],
                'endX' => $wordGrid[$key - 1]['endX'] + strlen($word) - 1,
                'endY' => $wordGrid[$key - 1]['endY']
            ];
            break;
        case 'v';
            $wordGrid[$key] = [
                'word' => $word,
                'startX' => $wordGrid[$key - 1]['endX'],
                'startY' => $wordGrid[$key - 1]['endY'],
                'endX' => $wordGrid[$key - 1]['endX'],
                'endY' => $wordGrid[$key - 1]['endY'] + strlen($word) - 1
            ];
            break;
    }
}

dump($wordGrid);

function cleanArray($array)
{
    foreach ($array as &$item) {
        $item = trim($item);
        $item = strtolower($item);
    }

    return $array;
}

function calculateWordOrientation($startX, $endX, $startY, $endY)
{
    if ($startX != $endX) {
        return 'v';
    }

    if ($startY != $endY) {
        return 'h';
    }
}