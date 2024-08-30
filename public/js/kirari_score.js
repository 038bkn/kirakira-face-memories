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
});
