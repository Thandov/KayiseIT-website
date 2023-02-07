<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ADD Service') }}
        </h2>
    </x-slot>
{{ $service }}
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

         
         <form action="{{ route('subservice.store', $service->id) }}" method="post">
    @csrf
    <div class="form-group m-3">
        <label for="name">Name</label>
        <input type="text" name="name[]" class="form-control" id="name" required>
    </div>
    <div class="form-group m-3">
        <label for="description">Description</label>
        <textarea name="description[]" class="form-control" id="description" rows="3" required></textarea>
    </div>
    <div class="form-group m-3">
        <label for="price">Price</label>
        <input type="number" name="price[]" class="form-control" id="price" required>
    </div>
    <button type="button" style="background-color: green" class="btn btn-success add-more">Add More</button>
    <button type="submit" style="background-color: blue" class="btn btn-primary">Submit</button>
</form>

<script>
    $(document).ready(function() {
        $(".add-more").click(function() {
            var html = `
                <div class="form-group m-3">
                    <label for="name">Name</label>
                    <input type="text" name="name[]" class="form-control" id="name" required>
                </div>
                <div class="form-group m-3">
                    <label for="description">Description</label>
                    <textarea name="description[]" class="form-control" id="description" rows="3" required></textarea>
                    </div>
        <div class="form-group m-3">
            <label for="price">Price</label>
            <input type="number" name="price[]" class="form-control" id="price" required>
        </div>
        <button type="button" style="background-color: red" class="btn btn-danger remove">Remove</button>
    `;
    $(".form-group:last").after(html);
    });

    $(document).on("click", "button.remove", function() {
        $(this).closest(".form-group").remove();
    });
});


</script>


</x-app-layout>
