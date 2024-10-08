<?php

// コメントテンプレート
$comments = [
    '0-19' => [
        'おっと！今日は控えめモード？明日は太陽よりも輝けるよ、たぶん！',
        'まるで夜の新月みたいに静かなキラリ☆。次は満月を目指そう！',
        'まだまだこれから！キラリ☆の電源が入る前のウォーミングアップかも？',
        '今日は控えめだけど、秘密兵器はまだ温存中ってことかな？',
        'ちょっと眠気が勝っちゃったかも！？でも、次は目覚めてキラリ☆全開だ！',
        'キラリ☆度が低すぎて、逆にレアキャラかも！コレクター心をくすぐる一品☆',
        'あれ？キラリ☆度が行方不明？捜索隊を派遣しよう！',
        'まるで影の忍者！キラリ☆度が忍びのようにひっそりと…！',
        '今日はエコモードかも！？次はキラリ☆度フルパワーで行こう！',
        '逆にレア！このキラリ☆度、隠れた魅力が詰まってるって信じてるよ！'
    ],
    '20-39' => [
        'おしい！キラキラ度、まだ充電中かも！？次はフルパワーで！',
        'ほら、ちょっとキラリ☆が顔を出してるよ！あともうひと輝き！',
        'キラキラ度、じわじわ成長中！これはまるで育成ゲーム！？',
        'もう少しで大爆発！キラキラ度、ただいま準備中☆',
        '今日はキラリ☆が控えめ？でも、それがまたクール！',
        '光が足りない？次はスポットライトを当てる番だよ☆',
        'このキラキラ度、まるでお月様！まだ半分だけど、満月は近い！',
        'キラリ☆度がスロースタート？でも、ゆっくり着実に行こう☆',
        'キラリ☆度はまだ小さな光…でも、小さな火種が大きな炎になる！',
        'ちょっと控えめなキラキラ…だけど、たまにはこういう日も必要だよね☆'
    ],
    '40-59' => [
        'おぉ！その輝き、まるで夕暮れ時のオレンジ色の太陽！あと一押しで夜のスター☆',
        'キラリ☆度、まさにホットケーキが焼ける直前の黄金色！このまま美味しそうに輝いて☆',
        'キラキラ度、中々いい感じ！もう少しでまばゆい光を放つ存在に☆',
        'その輝き、まるで夕日のよう！あともう少しで夜空の主役だ☆',
        'キラリ☆度、ちょうど真ん中！光と影の間を揺れ動くこの絶妙さがたまらない☆',
        'おっ！キラキラが光ってきたね！このまま行けば君は次のスター☆',
        'そのキラリ☆度、まるでクレセントムーン！満月はもうすぐそこだ☆',
        '輝きの波に乗ってるね！もう少しでビッグウェーブが来るかも☆',
        'その光、まるでキャンプファイヤー！これからもっと燃え上がる予感☆',
        'キラリ☆度、ちょうど良い具合にスパークしてる！次回はもっと火花を散らして☆'
    ],
    '60-79' => [
        'おっと！そのキラリ☆度、もしかして夜の街灯より明るいかも！？',
        '眩しい！このキラリ☆度なら、サングラスを持ってるか確認したほうがいいかも☆',
        'この輝き…誰かが間違えて君をスターだと思い始める頃かな？',
        'そのキラリ☆度、まるで映画のワンシーンみたいにドラマチック☆',
        'あと一押しで銀河に名前が刻まれるかも！？この調子で輝いて！',
        'あまりの輝きに、うっかり太陽と張り合っちゃいそうだよ☆',
        'これはもう、夜空の星たちが君を羨ましがってるレベルだね☆',
        'もはや君が輝く場所はここだけじゃない！世界中にその光を届けて☆',
        'そのキラリ☆度、もはやキラキラのオーラが見える！？近づくと眩しいかも☆',
        'キラリ☆度がここまで来たなら、次は太陽系外デビューも視野に！？'
    ],
    '80-100' => [
        'そのキラリ☆度、眩しすぎて太陽が嫉妬してるよ！',
        'キラリ☆度3150点！まるでダイヤモンドよりも輝いてる！',
        'もう光の速さでキラキラ☆！今すぐスーパースターになれるよ！',
        'キラリ☆度が高すぎて、宇宙からも見えるかも！エイリアンもビックリ☆',
        'そのキラリ☆度、もはや伝説級！博物館に展示しよう！',
        'キラリ☆度3150点！夜空に浮かぶ新星が誕生した瞬間だね☆',
        '眩しすぎる！周りの人たちにサングラスを配らなきゃ☆',
        'キラリ☆度が高すぎて、もはや自然現象！？オーロラよりも輝いてる☆',
        'このキラリ☆度、もはや他の惑星からも見えるかも！？地球代表の輝き☆',
        'そのキラリ☆度で街を歩けば、ライトアップの代わりになれるかも☆'
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
