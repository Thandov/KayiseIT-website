<x-app-layout>
    <!-- Meta tags  -->
    @section('meta')
    @php
    $metaTitle = "Home - Welcome to Kayise IT";
    $metaDescription = "Explore our innovative technology solutions and experience unparalleled customer satisfaction.";
    $metaKeywords = "YALI2024, YALINetwork, MandelaWashingtonFellowship";
    @endphp
    @endsection

    <div class="py-5 px-4 md:px-8 max-w-screen-xl mx-auto">

        <!-- Content -->
        <div class="mt-4 mx-4 md:grid md:grid-cols-5 gap-4">
            <div class="col-span-3">
                <div class="imgwrp overflow-hidden">
                    <img src="../images/events/MWF2024.jpg" alt="Mandela Wahsington Fellowship" class="mx-auto">
                </div>
            </div>
            <div class="col-span-2 grid grid-row-s-3 ">
                <div>
                    <p class="smalltxt font-bold mb-2">Event</p>
                    <h1 class="bigtxt font-bold text-5xl mb-4">Mandela Washington Fellowship</h1>
                    <p>MWF Application Walkthrough. Come listen and ask your questions.
                    <ul>
                        <li><strong>Date:</strong> Wednesday, August 30</li>
                        <li><strong>Time:</strong> 6:30 – 7:30pm</li>
                        <li><strong>Time Zone:</strong> Africa/Johannesburg</li>
                    </ul>
                    Video call link: <a class="text-blue-500" href="https://meet.google.com/tdk-drfo-nza">Click Here</a>
                    </p>
                </div>
                <form method="POST" action="{{ route('subscribe') }}">
                    @csrf

                    <div class="mt-2">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" id="name" name="name" placeholder="Name" required>
                    </div>

                    <div class="mt-2">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" class="form-input block w-full sm:text-sm sm:leading-5 transition duration-150 ease-in-out sm:rounded-md" id="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-kayise-blue border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-150 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>