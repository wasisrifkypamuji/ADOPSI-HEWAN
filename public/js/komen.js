
document.getElementById("fotoInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById("imagePreview").classList.remove("d-none");
        document.getElementById("imagePreviewImg").src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  document.getElementById("videoInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById("videoPreview").classList.remove("d-none");
        document.getElementById("videoPreviewVid").src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  document.getElementById("imagePreviewImg")?.addEventListener("click", function() {
    $('#imageModal').modal('show');
  });

  document.getElementById("videoPreviewVid")?.addEventListener("click", function() {
    $('#videoModal').modal('show');
  });

  function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`replyForm${commentId}`);
    if (replyForm.style.display === 'none') {
        replyForm.style.display = 'block';
    } else {
        replyForm.style.display = 'none';
        
    }

  }

function previewReplyImage(input, commentId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById(`replyImagePreview${commentId}`);
        
        reader.onload = function(e) {
            preview.classList.remove("d-none");
            preview.querySelector('img').src = e.target.result;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function previewReplyVideo(input, commentId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById(`replyVideoPreview${commentId}`);
        
        reader.onload = function(e) {
            preview.classList.remove("d-none");
            preview.querySelector('video source').src = e.target.result;
            preview.querySelector('video').load();
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`replyForm${commentId}`);
    const replyTextarea = replyForm.querySelector("textarea[name='komen']");
    const replyImagePreview = document.getElementById(`replyImagePreview${commentId}`);
    const replyVideoPreview = document.getElementById(`replyVideoPreview${commentId}`);
    const replyImageInput = replyForm.querySelector("input[name='foto']");
    const replyVideoInput = replyForm.querySelector("input[name='video']");

    if (replyForm.style.display === 'none') {
        replyForm.style.display = 'block';
    } else {
        replyVideoPreview.classList.add("d-none");
        replyImagePreview.classList.add("d-none");
        replyForm.style.display = 'none';
        replyImagePreview.querySelector("img").src = "";
        replyVideoPreview.querySelector("video source").src = "";
        replyVideoPreview.querySelector("video").load();
        replyTextarea.value = "";
        replyImageInput.value = "";
        replyVideoInput.value = "";
    }
}


// Tombol batal

function handleTextareaInput(event) {
    const cancelButtonSection = document.getElementById('btn-batal');
    const textAreaValue = event.target.value.trim();
  
    if (textAreaValue !== '') {
      cancelButtonSection.classList.remove('d-none');
    } else {
      cancelButtonSection.classList.add('d-none');
    }
  }
function handleFileInput(event) {
    const file = event.target.files[0];
    const fileInputId = event.target.id;
    const cancelButtonSection = document.getElementById('btn-batal');
    
    if (file) {
      cancelButtonSection.classList.remove('d-none'); 
  
      if (fileInputId === 'fotoInput') {
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewImg = document.getElementById('imagePreviewImg');
        const reader = new FileReader();
  
        reader.onload = function (e) {
          imagePreviewImg.src = e.target.result;
          imagePreview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
      } else if (fileInputId === 'videoInput') {
        const videoPreview = document.getElementById('videoPreview');
        const videoSource = document.getElementById('videoSource');
  
        videoSource.src = URL.createObjectURL(file);
        videoPreview.classList.remove('d-none');
      }
    }
  }
  
  function clearPreview() {
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewImg = document.getElementById('imagePreviewImg');
    const videoPreview = document.getElementById('videoPreview');
    const videoSource = document.getElementById('videoSource');
    const cancelButtonSection = document.getElementById('btn-batal');
  
    if (imagePreview) {
      imagePreview.classList.add('d-none');
      imagePreviewImg.src = '#';
    }
  
    if (videoPreview) {
      videoPreview.classList.add('d-none');
      videoSource.src = '#';
      videoPreview.querySelector('video').load(); // Reset video
    }
      cancelButtonSection.classList.add('d-none');
  }
  
  document.getElementById('fotoInput').addEventListener('change', handleFileInput);
  document.getElementById('videoInput').addEventListener('change', handleFileInput);
  const textArea = document.querySelector('textarea[name="komen"]');
    if (textArea) {
        textArea.addEventListener('input', handleTextareaInput);
    }