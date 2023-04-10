<div class="bg-white rounded-md shadow-md p-4 md:p-8">
    <form action="{{ route('contact.contact') }}" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend class="text-lg font-medium mb-4">Contact Information</legend>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="w-full">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="text" id="name" name="name" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" placeholder="Your Name" required>
                    </div>
                </div>
                <div class="w-full">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Your Email</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="email" id="email" name="email" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" placeholder="Your Email" required>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="mt-8">
            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
            <div class="relative rounded-md shadow-sm">
                <input type="text" id="subject" name="subject" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" placeholder="Subject" required>
            </div>
        </div>
        <div class="mt-8">
            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
            <div class="relative rounded-md shadow-sm">
                <textarea id="message" name="message" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 sm:rounded-md" rows="5" style="height: 150px" placeholder="Your Message" required></textarea>
            </div>
        </div>
        <div class="mt-8">
            <button type="submit" id="send-message-btn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Send Message
            </button>
        </div>
    </form>
</div>