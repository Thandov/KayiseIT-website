@if (session('error') || session('success') || session('warning'))
<script>
const alertType = @json(session('error') ? 'error' : (session('warning') ? 'warning' : 'success'));
const alertTitle = @json(session('error') ? 'Error' : (session('warning') ? 'Warning' : 'Success'));
const alertMessage = @json(session('error') ?? session('warning') ?? session('success'));

Swal.fire({
    icon: alertType,
    title: alertTitle,
    text: alertMessage,
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
});
</script>
@endif
