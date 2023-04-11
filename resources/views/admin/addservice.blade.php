<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD New Service') }}
        </h2>
    </x-slot>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="bg-gray-100">
        <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                <x-add-service-form/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
</script>