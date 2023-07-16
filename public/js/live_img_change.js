// Function to handle the image click event
function handleImageClick(event) {
    event.preventDefault(); // Prevent default behavior of the label click
    document.getElementById('profile_picture_input').click();
}

// Function to handle the file input change event
function handleFileInputChange(event) {
    const file = event.target.files[0];
    if (file) {
        // Set the selected file to the profile_picture input field
        document.querySelector('input[name="profile_picture"]').files = event.target.files;

        // Read the selected file as a Data URL
        const reader = new FileReader();
        reader.onload = function (e) {
            // Set the preview image source to the selected file
            document.getElementById('profile_picture_preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// Add click event listener to the profile picture label
document.querySelector('label[for="profile_picture_input"]').addEventListener('click', handleImageClick);

// Add change event listener to the profile picture input
document.getElementById('profile_picture_input').addEventListener('change', handleFileInputChange);
