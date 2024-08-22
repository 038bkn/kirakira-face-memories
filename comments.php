<?php

// コメントテンプレート
$comments = [
    '0-19' => [
        'もう少し頑張りましょう！',
        'まだまだこれから！',
        '次はもっとキラキラしよう！'
    ],
    '20-39' => [
        '良い感じですが、さらに向上を目指しましょう！',
        'なかなか良いですね！',
        'もう少しで完璧！'
    ],
    '40-59' => [
        'とても良いです！この調子で！',
        '素晴らしいですね！',
        'もう一息で満点！'
    ],
    '60-79' => [
        '素晴らしいです！',
        'かなりのキラキラ度！',
        '完璧に近い！'
    ],
    '80-100' => [
        '完璧です！おめでとうございます！',
        'すごいキラキラ度！',
        'もう文句なしの出来栄え！'
    ]
];

// コメントをランダムに選ぶ関数
function getRandomComment($score) {
    global $comments;

    if ($score <= 19) {
        $range = $comments['0-19'];
    } elseif ($score <= 39) {
        $range = $comments['20-39'];
    } elseif ($score <= 59) {
        $range = $comments['40-59'];
    } elseif ($score <= 79) {
        $range = $comments['60-79'];
    } else {
        $range = $comments['80-100'];
    }

    return $range[array_rand($range)];
}
