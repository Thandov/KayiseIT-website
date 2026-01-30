<!-- Internship Modal -->
<div id="internship-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                    Add Internship Application
                </h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form id="internship-form" class="mt-4">
                @csrf
                <input type="hidden" id="internship-id" name="id">
                <input type="hidden" id="form-method" name="_method" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- ID Number -->
                    <div>
                        <label for="id_no" class="block text-sm font-medium text-gray-700 mb-1">ID Number *</label>
                        <input type="text" id="id_no" name="id_no" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Age -->
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age *</label>
                        <input type="number" id="age" name="age" required min="16" max="65"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                        <textarea id="address" name="address" rows="2" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <!-- High School -->
                    <div>
                        <label for="high_school" class="block text-sm font-medium text-gray-700 mb-1">High School *</label>
                        <input type="text" id="high_school" name="high_school" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Year of Completion -->
                    <div>
                        <label for="year_of_completion" class="block text-sm font-medium text-gray-700 mb-1">Year of Completion *</label>
                        <input type="number" id="year_of_completion" name="year_of_completion" required min="1990" max="2024"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Qualification -->
                    <div>
                        <label for="qualification" class="block text-sm font-medium text-gray-700 mb-1">Qualification *</label>
                        <input type="text" id="qualification" name="qualification" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Year Obtained -->
                    <div>
                        <label for="year_obtained" class="block text-sm font-medium text-gray-700 mb-1">Year Obtained *</label>
                        <input type="number" id="year_obtained" name="year_obtained" required min="1990" max="2024"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Institution -->
                    <div>
                        <label for="institution" class="block text-sm font-medium text-gray-700 mb-1">Institution *</label>
                        <input type="text" id="institution" name="institution" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Application Type -->
                    <div>
                        <label for="app_type" class="block text-sm font-medium text-gray-700 mb-1">Application Type *</label>
                        <select id="app_type" name="app_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select Type</option>
                            <option value="internship">Internship</option>
                            <option value="learnership">Learnership</option>
                            <option value="apprenticeship">Apprenticeship</option>
                        </select>
                    </div>

                    <!-- Field -->
                    <div>
                        <label for="field" class="block text-sm font-medium text-gray-700 mb-1">Field of Study *</label>
                        <input type="text" id="field" name="field" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                    <button type="button" onclick="closeModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit" id="submit-btn"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div id="view-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Internship Application Details</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div id="view-content" class="mt-4">
                <!-- Content will be loaded here -->
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end mt-6 pt-4 border-t">
                <button onclick="closeViewModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Modal functions
function openModal(editId = null) {
    const modal = document.getElementById('internship-modal');
    const title = document.getElementById('modal-title');
    const form = document.getElementById('internship-form');
    const methodInput = document.getElementById('form-method');
    const submitBtn = document.getElementById('submit-btn');
    
    if (editId) {
        title.textContent = 'Edit Internship Application';
        submitBtn.textContent = 'Update';
        methodInput.value = 'PUT';
        loadInternshipData(editId);
    } else {
        title.textContent = 'Add Internship Application';
        submitBtn.textContent = 'Save';
        methodInput.value = 'POST';
        form.reset();
        document.getElementById('internship-id').value = '';
    }
    
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('internship-modal').classList.add('hidden');
}

function openViewModal(id) {
    const modal = document.getElementById('view-modal');
    loadInternshipView(id);
    modal.classList.remove('hidden');
}

function closeViewModal() {
    document.getElementById('view-modal').classList.add('hidden');
}

// Load internship data for editing
function loadInternshipData(id) {
    fetch(`/dashboard/internships/view/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const internship = data.internship;
                document.getElementById('internship-id').value = internship.id;
                document.getElementById('name').value = internship.name || '';
                document.getElementById('email').value = internship.email || '';
                document.getElementById('id_no').value = internship.id_no || '';
                document.getElementById('age').value = internship.age || '';
                document.getElementById('address').value = internship.address || '';
                document.getElementById('high_school').value = internship.high_school || '';
                document.getElementById('year_of_completion').value = internship.year_of_completion || '';
                document.getElementById('qualification').value = internship.qualification || '';
                document.getElementById('year_obtained').value = internship.year_obtained || '';
                document.getElementById('institution').value = internship.institution || '';
                document.getElementById('app_type').value = internship.app_type || '';
                document.getElementById('field').value = internship.field || '';
                document.getElementById('status').value = internship.status || 'pending';
            }
        })
        .catch(error => {
            console.error('Error loading internship data:', error);
            alert('Error loading internship data');
        });
}

// Load internship data for viewing
function loadInternshipView(id) {
    fetch(`/dashboard/internships/view/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const internship = data.internship;
                const content = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><strong>Name:</strong> ${internship.name || 'N/A'}</div>
                        <div><strong>Email:</strong> ${internship.email || 'N/A'}</div>
                        <div><strong>ID Number:</strong> ${internship.id_no || 'N/A'}</div>
                        <div><strong>Age:</strong> ${internship.age || 'N/A'}</div>
                        <div class="md:col-span-2"><strong>Address:</strong> ${internship.address || 'N/A'}</div>
                        <div><strong>High School:</strong> ${internship.high_school || 'N/A'}</div>
                        <div><strong>Year of Completion:</strong> ${internship.year_of_completion || 'N/A'}</div>
                        <div><strong>Qualification:</strong> ${internship.qualification || 'N/A'}</div>
                        <div><strong>Year Obtained:</strong> ${internship.year_obtained || 'N/A'}</div>
                        <div><strong>Institution:</strong> ${internship.institution || 'N/A'}</div>
                        <div><strong>Application Type:</strong> ${internship.app_type || 'N/A'}</div>
                        <div><strong>Field:</strong> ${internship.field || 'N/A'}</div>
                        <div><strong>Status:</strong> <span class="px-2 py-1 text-xs font-semibold rounded-full ${internship.status === 'approved' ? 'bg-green-100 text-green-800' : (internship.status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')}">${internship.status || 'pending'}</span></div>
                        <div><strong>Created:</strong> ${new Date(internship.created_at).toLocaleDateString()}</div>
                    </div>
                `;
                document.getElementById('view-content').innerHTML = content;
            }
        })
        .catch(error => {
            console.error('Error loading internship data:', error);
            alert('Error loading internship data');
        });
}

// Form submission
document.getElementById('internship-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('internship-id').value;
    const method = document.getElementById('form-method').value;
    
    let url = '/dashboard/internships/store';
    if (method === 'PUT' && id) {
        url = `/dashboard/internships/update/${id}`;
    }
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal();
            location.reload();
        } else {
            alert(data.message || 'Error saving internship');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving internship');
    });
});
</script>
