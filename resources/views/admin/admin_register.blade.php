<?php
// admin_register.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Hotel Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/admin_login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-modal">
        <button class="close-btn" onclick="window.location.href='{{route('user-selection')}}'">&times;</button>
        <h2>Admin Registration</h2>

        <form action="{{route('admin-register.store')}}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>
                <span class="input-icon"><i class="fa fa-user"></i></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span class="input-icon"><i class="fa fa-envelope"></i></span>
            </div>
            <div class="form-group">
                <label for="role">Admin Role</label>
                <input type="text" id="admin_role" name="admin_role" required>
                <input type="hidden" name="role" value="admin">
                <span class="input-icon"><i class="fa fa-user-shield"></i></span>
            </div>
                
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="input-icon"><i class="fa fa-lock"></i></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
                <span class="input-icon"><i class="fa fa-lock"></i></span>
            </div>
            <button type="submit" class="login-btn">Register</button>
        </form>
                
        <div class="register-link">
            Already have an account?
            <a href="{{ route('admin-login') }}" class="register-btn">Admin Login</a>
        </div>
                @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '{{ session("success") }}',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>
                @endif
    </div>
</body>
</html> 