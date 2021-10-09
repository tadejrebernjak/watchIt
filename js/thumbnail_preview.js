thumbnailInput = document.getElementById("thumbnail-file");
thumbnail = document.getElementById("thumbnail");

thumbnailInput.onchange = evt => {
    const [file] = thumbnailInput.files;
    if (file) {
      thumbnail.src = URL.createObjectURL(file);
    }
  }