<x-app-layout>
    <div class="container p-5" id="terms">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="">
                    <div class="p-4">
                        <x-titlestyle smheading="Join Our Team" bgheading="Apply For Job Opportunities" alignment="text-left" smheadingcolor="" bgheadingcolor=""></x-titlestyle>
                        <p class="text-left">As a leading IT company, we're always on the lookout for talented individuals to join our dynamic team and contribute to our innovative projects. If you're passionate about technology and eager to make an impact in the IT industry, you're in the right place. While there may not be job openings at the moment, we encourage you to submit your resume for future consideration. When opportunities arise, we'll review your application and reach out if there's a match. Take the first step towards an exciting career with us by clicking the button below to apply. We look forward to potentially welcoming you aboard!</p>
                    </div>
                </div>

                <div class="px-4">
                    @if(Auth::check())
                    <a href="{{ route('internship_application') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPLY</a>
                    @else
                    <a href="{{ route('registerintern') }}" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 text-center">APPLY</a>
                    @endif
                </div>

            </div>
        </div>
    </div>

</x-app-layout>