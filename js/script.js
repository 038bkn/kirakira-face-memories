// ファイル入力関連の処理
document.addEventListener("DOMContentLoaded", function() {
  var fileInput = document.querySelector('.file-input');
  var dropArea = document.querySelector('.file-drop-area');

  if (fileInput && dropArea) {
      // ドラッグエリアをハイライト
      fileInput.addEventListener('dragenter', function() {
          dropArea.classList.add('is-active');
      });
      fileInput.addEventListener('focus', function() {
          dropArea.classList.add('is-active');
      });
      fileInput.addEventListener('click', function() {
          dropArea.classList.add('is-active');
      });

      // 通常状態に戻す
      fileInput.addEventListener('dragleave', function() {
          dropArea.classList.remove('is-active');
      });
      fileInput.addEventListener('blur', function() {
          dropArea.classList.remove('is-active');
      });
      fileInput.addEventListener('drop', function() {
          dropArea.classList.remove('is-active');
      });

      // ファイル名を表示
      fileInput.addEventListener('change', function() {
          var filesCount = fileInput.files.length;
          var textContainer = dropArea.querySelector('.file-msg');

          if (filesCount === 1) {
              // 単一ファイルが選択された場合、ファイル名を表示
              var fileName = fileInput.value.split('\\').pop();
              textContainer.textContent = fileName;
          } else {
              // 複数ファイルが選択された場合、ファイル数を表示
              textContainer.textContent = filesCount + ' files selected';
          }
      });
  }

  // 画像プレビュー機能
  var imagePreviewContainer = document.getElementById('image-preview-container');
  var imagePreview = document.getElementById('image-preview');
  if (fileInput && imagePreview) {
      fileInput.addEventListener('change', function(event) {
          var file = event.target.files[0];
          var reader = new FileReader();

          reader.onload = function(e) {
              imagePreview.src = e.target.result;
              imagePreview.style.display = 'block';
              imagePreviewContainer.querySelector('.lottie').style.display = 'none'; // Lottieアニメーションを非表示にする
          };

          if (file) {
              reader.readAsDataURL(file);
          }
      });
  }

  // スライドショー関連の処理
  let slideIndex = 0;
  function showSlides() {
      var slides = document.getElementsByClassName("slide");
      var dots = document.getElementsByClassName("dot");

      // スライドやドットが存在しない場合、処理を中断
      if (slides.length === 0 || dots.length === 0) {
          console.log("スライドやドットが存在しません");
          return;
      }

      // 全てのスライドを非表示にする
      for (let i = 0; i < slides.length; i++) {
          slides[i].style.display = "none"; 
      }

      slideIndex++;
      if (slideIndex > slides.length) {
          slideIndex = 1;
      }

      // ドットのアクティブ状態をリセット
      for (let i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }

      // 現在のスライドを表示し、対応するドットをアクティブにする
      slides[slideIndex-1].style.display = "block"; 
      dots[slideIndex-1].className += " active";

      // 2秒ごとにスライドを自動で切り替え
      setTimeout(showSlides, 2000);
  }

  showSlides(); // スライドショーの自動再生を開始
});
