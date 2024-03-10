<div class="rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 image-container">

    <form action="{{ url('dashboard/gallery/delete', $picid) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?')">
        @csrf
        @method('DELETE')
        <input type="hidden" name="photo_id" value="{{$picid}}">
        <input type="hidden" name="path" value="{{$pic}}">
        <x-front-end-btn linking="/dashboard/clients/delete" color="red" showme="delete_staff" name='Delete' />
    </form>
    <a href="#">
        <img class="rounded-t-lg" src="{{ asset($pic) }}" alt="" />
    </a>
</div>