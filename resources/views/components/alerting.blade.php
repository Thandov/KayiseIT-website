@if (session('error') || session('success'))
<script>
// Determine the alert type and title based on the session data
const alertType = "{{ session('error') ? 'error' : 'success' }}";
const alertTitle = "{{ session('error') ? 'Error' : 'Success' }}";

// Display SweetAlert with the corresponding message
Swal.fire({
    icon: alertType,
    title: alertTitle,
    text: "{{ session('error') ?? session('success') }}",
});
</script>
@endif