<?php

/*
    Задача №2
    Имеется строка:
    https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3
    Напишите функцию, которая:
    1.	удалит параметры со значением “3”;
    2.	отсортирует параметры по значению;
    3.	добавит параметр url со значением из переданной ссылки без параметров (в примере: /test/index.html);
    4.	сформирует и вернёт валидный URL на корень указанного в ссылке хоста.
    В указанном примере функцией должно быть возвращено:
    https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html
*/

##############################################################################################


function linkHandler($srcUrl)
{
    extract(parse_url($srcUrl));

    $resLink = [
        'scheme' => $scheme . '://',
        'host' => $host . '/',
        'path' => $path,
        'query' => '?',
    ];
    $srcQuery = explode('&', $query);
    $freshQuery = [];

    foreach ($srcQuery as $param) {
        $paramCont = explode('=', $param);
        if ($paramCont[1] === '3') continue;
        $freshQuery[$paramCont[0]] = $paramCont[1];
    }

    asort($freshQuery, SORT_NUMERIC);

    foreach ($freshQuery as $key => $val) {
        $resLink['query'] .= $key . '=' . $val . '&';
    }

    // & можно не убирать, однако строка должна быть завершенной, поэтому это не рекомендуется
    $resLink['query'] = substr($resLink['query'], 0, -1);
    return $resLink['scheme'] . $resLink['host'] . $resLink['query'] . '&url=' . urlencode($resLink['path']);
}

// клиент
$link = "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3";
print_r(linkHandler($link));

