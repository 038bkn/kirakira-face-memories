$(document).ready(function() {
    // 画像プレビュー
    $.getJSON("get_random_images.php", function(data) {
        if (data.length > 0) {
            const image = data[0];
            $("#image-preview").attr("src", "uploads/" + image.file_name).show(); // パスが正しいか確認
            $("#kirari-score").text("キラリ☆度: " + image.kirari_score + "点");
            $("#kirari-comment").text(getComment(image.kirari_score));
        } else {
            $("#kirari-score").text("画像が見つかりませんでした。");
        }
    });

    function getComment(score) {
        if (score <= 19) {
            return 'もう少し頑張りましょう！';
        } else if (score <= 39) {
            return '良い感じですが、さらに向上を目指しましょう！';
        } else if (score <= 59) {
            return 'とても良いです！この調子で！';
        } else if (score <= 79) {
            return '素晴らしいです！';
        } else {
            return '完璧です！おめでとうございます！';
        }
    }
});
