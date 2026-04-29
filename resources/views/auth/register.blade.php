<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="row bg-white rounded shadow overflow-hidden">

        <!-- LEFT SIDE IMAGE -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-dark p-4">
            <img src="{{ asset('images/Jesus is Lord.jpg') }}" class="img-fluid rounded shadow" style="max-height: 85vh; object-fit: cover;" alt="Church Image">
        </div>

        <!-- RIGHT SIDE FORM -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-light p-4">
            <div class="w-100" style="max-width: 500px;">

                <div class="text-center mb-4">
                    <h2 class="fw-bold">Create Account</h2>
                    <p class="text-muted">Join PCEA Chaka Church Community</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter full name">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email">

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="07XXXXXXXX">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Register
                    </button>

                </form>

                <p class="text-center mt-4 mb-0">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        <b>Login</b>
                    </a>
                </p>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
