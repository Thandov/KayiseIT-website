@if (session('error') || session('success') || session('warning'))
<script>
// Determine the alert type and title based on the session data
const alertType = "{{ session('error') ? 'error' : (session('warning') ? 'warning' : 'success') }}";
const alertTitle = "{{ session('error') ? 'Error' : (session('warning') ? 'Warning' : 'Success') }}";
const alertMessage = "{{ session('error') ?? session('warning') ?? session('success') }}";

// Display SweetAlert with the corresponding message
Swal.fire({
    icon: alertType,
    title: alertTitle,
    text: alertMessage,
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});
</script>
@endif