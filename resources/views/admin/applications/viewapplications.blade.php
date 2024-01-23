<x-app-layout>
    <div class="flex justify-content-center p-5 bg-slate-100">
        <div class="registration-section current-section" id="section1">
            <h1 class="my-4">Applicant Details</h1>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <td class="px-5">{{ $applications->name }}</td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td class="px-5">{{ $applications->surname }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td class="px-5">{{ $applications->dob }}</td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td class="px-5">{{ $applications->age }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td class="px-5">{{ $applications->gender }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td class="px-5">{{ $applications->highest_level }}</td>
                </tr>
                <tr>
                    <th>School Name</th>
                    <td class="px-5">{{ $applications->School_name }}</td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td class="px-5">{{ $applications->number }}</td>
                </tr>
                <tr>
                    <th>address</th>
                    <td class="px-5">{{ $applications->address }}</td>
                </tr>
            </table>

            <h1 class="my-4">Guardian Details</h1>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <td class="px-5">{{ $applications->guardian_name }}</td>
                </tr>
                <tr>
                    <th>Relation</th>
                    <td class="px-5">{{ $applications->relation }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td class="px-5">{{ $applications->guardian_number }}</td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td class="px-5">{{ $applications->guardian_email }}</td>
                </tr>
                <tr>
                    <th>Home Address</th>
                    <td class="px-5">{{ $applications->guardian_address }}</td>
                </tr>

            </table>

            <h1 class="my-4">Next Of kin</h1>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <td class="px-5">{{ $applications->kin_name }}</td>
                </tr>
                <tr>
                    <th>Relation</th>
                    <td class="px-5">{{ $applications->kin_relation }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td class="px-5">{{ $applications->kin_number }}</td>
                </tr>

            </table>

            <h1 class="my-4">Programme</h1>
            <table border="1">
                <tr>
                    <th>Name</th>
                    <td class="px-5">{{ $applications->course }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td class="px-5">R599</td>
                </tr>
            </table>
        </div>
</x-app-layout>