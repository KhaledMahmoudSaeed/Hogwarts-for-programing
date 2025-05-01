</div>
<script>
    // Trigger file input when "Change Photo" button is clicked
    document.querySelector('.btn-gold').addEventListener('click', function () {
        document.querySelector('.file-upload-input').click();
    });

    // Handle image preview when file is selected
    document.querySelector('.file-upload-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                const currentImage = document.querySelector('.picture');

                if (currentImage) {
                    if (currentImage.tagName === 'IMG') {
                        // Replace the src of existing <img> tag
                        currentImage.src = event.target.result;
                    } else {
                        // Replace the icon div with a new <img> tag
                        const newImage = document.createElement('img');
                        newImage.src = event.target.result;
                        newImage.className = 'picture rounded-full';
                        currentImage.parentNode.replaceChild(newImage, currentImage);
                    }
                } else {
                    console.error("Profile picture element not found.");
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>

</html>