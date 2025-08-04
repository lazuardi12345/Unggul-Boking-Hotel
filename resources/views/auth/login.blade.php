<?php
// login.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-modal">
        <button class="close-btn" onclick="window.location.href='{{ route('user-selection') }}'">&times;</button>
        <h2>Login</h2>
        <form method="post" action="{{ route('customer-login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span class="input-icon"><i class="fa fa-envelope"></i></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="input-icon"><i class="fa fa-lock"></i></span>
            </div>
            <div class="form-options">
                <label><input type="checkbox" name="remember"> Remember me</label>
                <a href="{{ route('password.request') }}">Forget Password?</a>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="register-link">
            Don't have an account?
            <a href="{{ route('customer-register') }}" class="register-btn">Register</a>
        </div>
    </div>
</body>
<!-- Tampilkan notifikasi jika ada session flash -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: true
    });
</script>
@endif
</html> 