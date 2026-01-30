<x-add-service-form/>

<script>
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL(input) {

if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        const img = document.getElementById(jQuery(input).data('target'));
        img.setAttribute('src', '');
        img.setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
}
</script>