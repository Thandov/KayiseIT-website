<!-- Ensure the relevant framework-specific blade or HTML tags are added properly -->
<div id="profile_pic_wrapper" class="{{$classing}} shadow overflow-hidden border-b border-gray-200 sm:rounded-lg flex items-center justify-center">
    <label for="profile_picture_input">
        @if (isset($image) && $image ?? '')
        <img id="profile_picture_preview" src="{{ asset($image) }}" alt="Profile Picture">
        @else
        <img id="profile_picture_preview" src="#" alt="Profile Picture"> <!-- Add a default image source or leave it blank -->
        @endif
    </label>
    <input id="profile_picture_input" type="file" name="profile_picture" style="display: none;">
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to handle the file input change event
        function handleFileInputChange(event) {
            const file = event.target.files[0];
            if (file) {
                // Read the selected file as a Data URL
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Set the preview image source to the selected file
                    document.getElementById('profile_picture_preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        // Add change event listener to the profile picture input
        document.getElementById('profile_picture_input').addEventListener('change', handleFileInputChange);
    });
</script>