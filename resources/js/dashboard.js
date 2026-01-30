document.addEventListener("DOMContentLoaded", function() {
    console.log("Dashboard script loaded");
    
    // Tab navigation functionality
    const navItems = document.querySelectorAll(".nav-item");
    const contentPanels = document.querySelectorAll(".content-panel");
    
    console.log("Nav items found:", navItems.length);
    console.log("Content panels found:", contentPanels.length);

    navItems.forEach((item) => {
        item.addEventListener("click", function(e) {
            // Only prevent default if it's actually a tab navigation item with data-tab attribute
            // AND it's not a regular link (has href attribute pointing to a route)
            const hasDataTab = this.getAttribute("data-tab");
            const isRegularLink = this.hasAttribute("href") && this.getAttribute("href").startsWith("/");
            
            if (hasDataTab && !isRegularLink) {
                e.preventDefault();
                console.log("Nav item clicked:", this);
                
                const targetTab = this.getAttribute("data-tab");
                console.log("Target tab:", targetTab);

                // Remove active class from all nav items
                navItems.forEach((nav) => {
                    nav.classList.remove("active");
                });

                // Add active class to clicked nav item
                this.classList.add("active");

                // Hide all content panels
                contentPanels.forEach((panel) => {
                    panel.classList.remove("show");
                    panel.style.display = "none";
                });

                // Show target panel
                const targetPanel = document.getElementById(targetTab + "-tab");
                console.log("Target panel:", targetPanel);
                
                if (targetPanel) {
                    targetPanel.style.display = "block";
                    // Force reflow to ensure display change is applied
                    targetPanel.offsetHeight;
                    targetPanel.classList.add("show");
                }

                // Update page title
                const tabName = this.querySelector("span:last-child")?.textContent;
                if (tabName) {
                    document.title = `${tabName} - Dashboard`;
                }

                // Keep current scroll position - no scroll to top
            } else {
                // Allow normal link navigation - don't prevent default
                console.log("Regular link clicked, allowing navigation:", this.getAttribute("href"));
            }
        });
    });

    // Button loading states
    const buttons = document.querySelectorAll(".btn-primary");
    buttons.forEach((button) => {
        button.addEventListener("click", function() {
            if (this.textContent.includes("+") || this.textContent.includes("Mark All")) {
                const originalText = this.textContent;
                this.textContent = "Loading...";
                this.disabled = true;
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.disabled = false;
                }, 1500);
            }
        });
    });

    // Keyboard navigation for sidebar
    document.addEventListener("keydown", function(event) {
        const activeItem = document.querySelector(".nav-item.active");
        if (!activeItem) return;

        const currentIndex = Array.from(navItems).indexOf(activeItem);
        let newIndex = currentIndex;

        switch(event.key) {
            case "ArrowDown":
                newIndex = (currentIndex + 1) % navItems.length;
                break;
            case "ArrowUp":
                newIndex = (currentIndex - 1 + navItems.length) % navItems.length;
                break;
            case "Enter":
            case " ":
                activeItem.click();
                return;
            default:
                return;
        }

        if (newIndex !== currentIndex) {
            event.preventDefault();
            navItems[newIndex].click();
        }
    });

    // Mobile sidebar toggle (for responsive design)
    const createMobileToggle = () => {
        const toggleBtn = document.createElement('button');
        toggleBtn.innerHTML = '☰';
        toggleBtn.className = 'fixed top-4 left-4 z-50 bg-white shadow-lg rounded-lg p-2 md:hidden';
        toggleBtn.onclick = () => {
            document.querySelector('.sidebar').classList.toggle('open');
        };
        document.body.appendChild(toggleBtn);
    };

    // Only create mobile toggle on smaller screens
    if (window.innerWidth <= 1024) {
        createMobileToggle();
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('button[onclick*="sidebar"]');
        
        if (window.innerWidth <= 1024 && 
            !sidebar.contains(e.target) && 
            !toggleBtn?.contains(e.target)) {
            sidebar.classList.remove('open');
        }
    });

    // Smooth animations for stat cards
    const statCards = document.querySelectorAll('.stat-card');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
            }
        });
    }, observerOptions);

    statCards.forEach(card => {
        observer.observe(card);
    });

    // Application Modal Functionality
    const modal = document.getElementById("applicationModal");
    const newApplicationBtn = document.getElementById("newApplicationBtn");
    const closeModal = document.getElementById("closeModal");
    const prevStep = document.getElementById("prevStep");
    const nextStep = document.getElementById("nextStep");
    const submitApplication = document.getElementById("submitApplication");
    
    let currentStep = 1;
    let selectedApplicationType = null;
    let selectedApplication = null;
    const totalSteps = 6;

    // Open modal
    if (newApplicationBtn) {
        newApplicationBtn.addEventListener("click", function() {
            modal.classList.remove("hidden");
            document.body.style.overflow = "hidden";
            prePopulateUserData();
        });
    }

    function prePopulateUserData() {
        // Auto-calculate age if DOB is provided
        const dobInput = document.getElementById('dob');
        const ageInput = document.getElementById('age');
        
        if (dobInput && ageInput) {
            // Add event listener for DOB changes
            dobInput.addEventListener('change', function() {
                if (this.value) {
                    const today = new Date();
                    const birthDate = new Date(this.value);
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    ageInput.value = age;
                }
            });
            
            // Auto-calculate on modal open if DOB exists but age doesn't
            if (dobInput.value && !ageInput.value) {
                const today = new Date();
                const birthDate = new Date(dobInput.value);
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                
                ageInput.value = age;
            }
        }
    }

    // Close modal
    if (closeModal) {
        closeModal.addEventListener("click", closeModalFunction);
    }

    // Close modal when clicking outside
    if (modal) {
        modal.addEventListener("click", function(e) {
            if (e.target === modal) {
                closeModalFunction();
            }
        });
    }

    // Escape key to close modal
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            closeModalFunction();
        }
    });

    function closeModalFunction() {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
        resetModal();
    }

    function resetModal() {
        currentStep = 1;
        selectedApplicationType = null;
        selectedApplication = null;
        updateStepDisplay();
        
        // Reset form
        document.querySelectorAll('.type-card').forEach(card => {
            card.classList.remove('selected');
        });
        
        // Clear available applications
        const container = document.getElementById('availableApplications');
        if (container) {
            container.innerHTML = '<!-- Available applications will be loaded here based on selected type -->';
        }
        
        // Clear all form inputs
        document.querySelectorAll('.form-input, .form-select, .form-textarea, .form-file').forEach(input => {
            if (!input.readOnly) {
                input.value = '';
            }
        });
    }

    function updateStepDisplay() {
        // Hide all steps
        document.querySelectorAll('.modal-step').forEach(step => {
            step.classList.remove('active');
        });
        
        // Show current step
        document.getElementById(`step${currentStep}`).classList.add('active');
        
        // Update step indicators
        document.querySelectorAll('.step-dot').forEach((dot, index) => {
            dot.classList.remove('active', 'completed');
            if (index + 1 < currentStep) {
                dot.classList.add('completed');
            } else if (index + 1 === currentStep) {
                dot.classList.add('active');
            }
        });
        
        // Update buttons
        prevStep.style.display = currentStep > 1 ? 'block' : 'none';
        nextStep.style.display = currentStep < totalSteps ? 'block' : 'none';
        submitApplication.style.display = currentStep === totalSteps ? 'block' : 'none';
        
        // Update next button text
        if (currentStep === totalSteps) {
            nextStep.style.display = 'none';
        } else if (currentStep === totalSteps - 1) {
            nextStep.textContent = 'Review & Submit';
        } else {
            nextStep.textContent = 'Next';
        }
    }

    // Application type selection
    document.querySelectorAll('.type-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.type-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            selectedApplicationType = this.dataset.type;
            loadAvailableApplications(selectedApplicationType);
        });
    });

    function loadAvailableApplications(type) {
        const container = document.getElementById('availableApplications');
        container.innerHTML = '<div class="loading">Loading available applications...</div>';
        
        // Mock data - replace with actual API call
        const availableApplications = {
            job: [
                {
                    id: 1,
                    title: "Frontend Developer",
                    description: "Join our team as a Frontend Developer working with React, Vue.js, and modern web technologies.",
                    course: "Frontend Development",
                    field: "Web Development",
                    duration: "Permanent",
                    requirements: "Bachelor's degree in Computer Science or related field",
                    location: "Cape Town",
                    salary: "R25,000 - R35,000"
                },
                {
                    id: 2,
                    title: "Backend Developer",
                    description: "Develop robust server-side applications using Laravel, Node.js, and cloud technologies.",
                    course: "Backend Development",
                    field: "Server Development",
                    duration: "Permanent",
                    requirements: "Experience with PHP, Laravel, MySQL",
                    location: "Johannesburg",
                    salary: "R30,000 - R40,000"
                }
            ],
            training: [
                {
                    id: 3,
                    title: "Full Stack Web Development",
                    description: "Comprehensive 6-month program covering frontend, backend, and database technologies.",
                    course: "Full Stack Development",
                    field: "Web Development",
                    duration: "6 Months",
                    requirements: "Basic programming knowledge",
                    location: "Online & Cape Town",
                    cost: "R15,000"
                },
                {
                    id: 4,
                    title: "Data Science & Analytics",
                    description: "Learn Python, machine learning, and data visualization in this intensive program.",
                    course: "Data Science",
                    field: "Analytics",
                    duration: "4 Months",
                    requirements: "Mathematics background preferred",
                    location: "Online",
                    cost: "R12,000"
                }
            ],
            internship: [
                {
                    id: 5,
                    title: "Software Development Intern",
                    description: "Gain hands-on experience in software development with mentorship from senior developers.",
                    course: "Software Development",
                    field: "General Programming",
                    duration: "3 Months",
                    requirements: "Computer Science student or graduate",
                    location: "Cape Town",
                    stipend: "R8,000/month"
                },
                {
                    id: 6,
                    title: "UI/UX Design Intern",
                    description: "Work on real projects designing user interfaces and experiences for our clients.",
                    course: "UI/UX Design",
                    field: "Design",
                    duration: "3 Months",
                    requirements: "Design portfolio required",
                    location: "Johannesburg",
                    stipend: "R6,000/month"
                }
            ]
        };

        // Simulate API delay
        setTimeout(() => {
            const applications = availableApplications[type] || [];
            displayAvailableApplications(applications);
        }, 500);
    }

    function displayAvailableApplications(applications) {
        const container = document.getElementById('availableApplications');
        
        if (applications.length === 0) {
            container.innerHTML = '<div class="no-applications">No applications available for this type at the moment.</div>';
            return;
        }

        const html = applications.map(app => `
            <div class="application-card" data-app-id="${app.id}">
                <h4 class="application-title">${app.title}</h4>
                <p class="application-description">${app.description}</p>
                
                <div class="application-details">
                    <div class="application-detail">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        ${app.course}
                    </div>
                    <div class="application-detail">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        ${app.duration}
                    </div>
                    <div class="application-detail">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        ${app.location}
                    </div>
                </div>
                
                <p class="application-requirements"><strong>Requirements:</strong> ${app.requirements}</p>
            </div>
        `).join('');

        container.innerHTML = `<div class="available-applications">${html}</div>`;

        // Add click handlers to application cards
        document.querySelectorAll('.application-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.application-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                selectedApplication = applications.find(app => app.id == this.dataset.appId);
                
                // Auto-populate the course and field fields
                if (selectedApplication) {
                    document.getElementById('course').value = selectedApplication.course;
                    document.getElementById('field').value = selectedApplication.field;
                }
            });
        });
    }

    // Next step
    if (nextStep) {
        nextStep.addEventListener('click', function() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStepDisplay();
                }
            }
        });
    }

    // Previous step
    if (prevStep) {
        prevStep.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                updateStepDisplay();
            }
        });
    }

    // Submit application
    if (submitApplication) {
        submitApplication.addEventListener('click', function() {
            if (validateCurrentStep()) {
                submitApplicationForm();
            }
        });
    }

    function validateCurrentStep() {
        if (currentStep === 1) {
            if (!selectedApplicationType) {
                alert('Please select an application type');
                return false;
            }
        } else if (currentStep === 2) {
            if (!selectedApplication) {
                alert('Please select an available application');
                return false;
            }
        } else if (currentStep === 3) {
            // Personal Information validation
            const name = document.getElementById('name').value.trim();
            const surname = document.getElementById('surname').value.trim();
            const dob = document.getElementById('dob').value;
            const gender = document.getElementById('gender').value;
            const idNo = document.getElementById('id_no').value.trim();
            const age = document.getElementById('age').value;
            const address = document.getElementById('address').value.trim();
            const number = document.getElementById('number').value.trim();
            
            if (!name) { alert('Please enter your first name'); return false; }
            if (!surname) { alert('Please enter your surname'); return false; }
            if (!dob) { alert('Please enter your date of birth'); return false; }
            if (!gender) { alert('Please select your gender'); return false; }
            if (!idNo) { alert('Please enter your ID number'); return false; }
            if (!age) { alert('Please enter your age'); return false; }
            if (!address) { alert('Please enter your address'); return false; }
            if (!number) { alert('Please enter your contact number'); return false; }
        } else if (currentStep === 4) {
            // Education Information validation
            const highestLevel = document.getElementById('highest_level').value;
            const schoolName = document.getElementById('school_name').value.trim();
            const qualification = document.getElementById('qualification').value.trim();
            const yearCompletion = document.getElementById('year_of_completion').value;
            
            if (!highestLevel) { alert('Please select your highest education level'); return false; }
            if (!schoolName) { alert('Please enter your school/institution name'); return false; }
            if (!qualification) { alert('Please enter your qualification/field of study'); return false; }
            if (!yearCompletion) { alert('Please enter your year of completion'); return false; }
        } else if (currentStep === 5) {
            // Guardian & Next of Kin validation
            const guardianName = document.getElementById('guardian_name').value.trim();
            const relation = document.getElementById('relation').value;
            const guardianNumber = document.getElementById('guardian_number').value.trim();
            const guardianAddress = document.getElementById('guardian_address').value.trim();
            const kinName = document.getElementById('kin_name').value.trim();
            const kinRelation = document.getElementById('kin_relation').value;
            const kinNumber = document.getElementById('kin_number').value.trim();
            
            if (!guardianName) { alert('Please enter guardian name'); return false; }
            if (!relation) { alert('Please select guardian relationship'); return false; }
            if (!guardianNumber) { alert('Please enter guardian contact number'); return false; }
            if (!guardianAddress) { alert('Please enter guardian address'); return false; }
            if (!kinName) { alert('Please enter next of kin name'); return false; }
            if (!kinRelation) { alert('Please select next of kin relationship'); return false; }
            if (!kinNumber) { alert('Please enter next of kin contact number'); return false; }
        } else if (currentStep === 6) {
            // Documents & Final Details validation
            const course = document.getElementById('course').value.trim();
            const cvFile = document.getElementById('cv_path').files[0];
            const idCopy = document.getElementById('id_copy_path').files[0];
            
            if (!course) { alert('Please enter the course/program you are interested in'); return false; }
            if (!cvFile) { alert('Please upload your CV/Resume'); return false; }
            if (!idCopy) { alert('Please upload your ID copy'); return false; }
        }
        return true;
    }

    function submitApplicationForm() {
        // Collect all form data matching the database structure
        const formData = {
            // Application type and basic info
            app_type: selectedApplicationType,
            application_id: selectedApplication.id,
            title: selectedApplication.title,
            course: selectedApplication.course,
            field: selectedApplication.field,
            
            // Personal Information (applications table)
            name: document.getElementById('name').value,
            surname: document.getElementById('surname').value,
            dob: document.getElementById('dob').value,
            gender: document.getElementById('gender').value,
            age: document.getElementById('age').value,
            
            // Education Information
            highest_level: document.getElementById('highest_level').value,
            School_name: document.getElementById('school_name').value,
            qualification: document.getElementById('qualification').value,
            year_of_completion: document.getElementById('year_of_completion').value,
            year_obtained: document.getElementById('year_obtained').value,
            institution: document.getElementById('school_name').value, // Same as school_name
            
            // Contact Information
            number: document.getElementById('number').value,
            address: document.getElementById('address').value,
            id_no: document.getElementById('id_no').value,
            
            // Guardian Information
            guardian_name: document.getElementById('guardian_name').value,
            relation: document.getElementById('relation').value,
            guardian_number: document.getElementById('guardian_number').value,
            guardian_email: document.getElementById('guardian_email').value,
            guardian_address: document.getElementById('guardian_address').value,
            
            // Next of Kin Information
            kin_name: document.getElementById('kin_name').value,
            kin_relation: document.getElementById('kin_relation').value,
            kin_number: document.getElementById('kin_number').value,
            
            // Course and Field
            course: document.getElementById('course').value,
            field: document.getElementById('field').value,
            
            // File uploads
            cv_path: document.getElementById('cv_path').files[0],
            id_copy_path: document.getElementById('id_copy_path').files[0],
            qualification_copy_path: document.getElementById('qualification_copy_path').files[0]
        };

        // Here you would typically send the data to your backend
        // You might want to use FormData for file uploads
        console.log('Application submitted:', formData);
        
        // Show success message
        alert('Application submitted successfully! Your application has been received and will be reviewed.');
        
        // Close modal
        closeModalFunction();
        
        // You could also add the new application to the applications list here
        // or refresh the applications section
    }
    
    console.log("Dashboard initialization complete");
});
