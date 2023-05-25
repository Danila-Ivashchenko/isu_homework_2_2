<?php

function translate($phrase, $lang) {
    $dict = [
        'en' => [
            'hello' => 'Hello!',
            'open' => 'open',
            'save' => 'save',
            'close_the_window' => 'Close the window?',
        ],
        'ru' => [
            'hello' => 'Привет!',
            'open' => 'открыть',
            'save' => 'сохранить',
            'close_the_window' => 'Закрыть окно?',
        ],
    ];

    $words = explode(' ', $phrase);
    $translated_words = [];

    foreach ($words as $word) {
        if (isset($dict[$lang][$word])) {
            $translated_words[] = $dict[$lang][$word];
        } else {
            $translated_words[] = $word;
        }
    }

    return implode(' ', $translated_words);
}


echo translate('save', 'en') . '<br>';
echo translate('hello save', 'ru') . '<br>';
echo translate('close_the_window open', 'ru') . '<br>';

?>