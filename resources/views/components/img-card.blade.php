<div class="rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 image-container">

    <form action="{{ url('dashboard/gallery/delete', $picid) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?')">
        @csrf
        @method('DELETE')
        <input type="hidden" name="photo_id" value="{{$picid}}">
        <input type="hidden" name="path" value="{{$pic}}">
        <button class="p-1 bg-red-600 position-absolute z-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </form>
    <a href="#">
        <img class="rounded-t-lg" src="{{ asset($pic) }}" alt="" />
    </a>
</div>