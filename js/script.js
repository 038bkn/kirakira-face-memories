var $fileInput = $('.file-input');
var $droparea = $('.file-drop-area');

// highlight drag area
$fileInput.on('dragenter focus click', function () {
  $droparea.addClass('is-active');
});

// back to normal state
$fileInput.on('dragleave blur drop', function () {
  $droparea.removeClass('is-active');
});

// change inner text
$fileInput.on('change', function () {
  var filesCount = $(this)[0].files.length;
  var $textContainer = $(this).prev();

  if (filesCount === 1) {
    // if single file is selected, show file name
    var fileName = $(this).val().split('\\').pop();
    $textContainer.text(fileName);
  } else {
    // otherwise show number of files
    $textContainer.text(filesCount + ' files selected');
  }
});

// 画像プレビュー機能
$(document).ready(function () {
  $('.file-input').on('change', function (event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#preview-message').hide(); // プレビューが表示される前のメッセージを非表示にする
      $('#image-preview').attr('src', e.target.result).show();
    }

    if (file) {
      reader.readAsDataURL(file);
    }
  });
});

// PHPからランダムに画像を取得
fetch('get_random_images.php')
  .then(response => response.json())
  .then(images => {
    const slideshowContainer = document.getElementById('slideshow-container');
    const dotsContainer = document.getElementById('dots-container');
    let slideIndex = 0;

    images.forEach((image, index) => {
      // スライドを追加
      const slideDiv = document.createElement('div');
      slideDiv.className = 'slide fade';
      slideDiv.innerHTML = `
                <img src="uploads/${image.file_name}" style="width:100%">
                <div class="caption">キラリ☆${image.kirari_score}点</div>
            `;
      slideshowContainer.appendChild(slideDiv);

      // ドットを追加
      const dotSpan = document.createElement('span');
      dotSpan.className = 'dot';
      dotSpan.onclick = () => currentSlide(index + 1);
      dotsContainer.appendChild(dotSpan);
    });

    showSlides();

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n - 1);
    }

    function showSlides() {
      let slides = document.getElementsByClassName("slide");
      let dots = document.getElementsByClassName("dot");
      if (slideIndex >= slides.length) { slideIndex = 0 }
      if (slideIndex < 0) { slideIndex = slides.length - 1 }
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex].style.display = "block";
      dots[slideIndex].className += " active";
      slideIndex++;
      setTimeout(showSlides, 5000); // 5秒ごとにスライドを自動で切り替え
    }
  })
  .catch(error => console.error('Error:', error));

  fetch('php/get_random_images.php')
    .then(response => response.json())
    .then(images => {
        const slideshowContainer = document.getElementById('slideshow-container');
        const dotsContainer = document.getElementById('dots-container');
        let slideIndex = 0;

        images.forEach((image, index) => {
            // スライドを追加
            const slideDiv = document.createElement('div');
            slideDiv.className = 'slide fade';
            slideDiv.innerHTML = `
                <img src="uploads/${image.file_name}" style="width:100%">
                <div class="caption">キラリ☆${image.kirari_score}点</div>
            `;
            slideshowContainer.appendChild(slideDiv);

            // ドットを追加
            const dotSpan = document.createElement('span');
            dotSpan.className = 'dot';
            dotSpan.onclick = () => currentSlide(index + 1);
            dotsContainer.appendChild(dotSpan);
        });

        showSlides();

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n - 1);
        }

        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");
            if (slideIndex >= slides.length) {slideIndex = 0}
            if (slideIndex < 0) {slideIndex = slides.length - 1}
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex].style.display = "block";  
            dots[slideIndex].className += " active";
            slideIndex++;
            setTimeout(showSlides, 5000); // 5秒ごとにスライドを自動で切り替え
        }
    })
    .catch(error => console.error('Error:', error));
