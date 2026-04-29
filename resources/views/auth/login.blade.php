<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <div class="row bg-white rounded shadow overflow-hidden">

        <!-- LEFT SIDE IMAGE -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-dark p-4">
            <img src="{{ asset('images/Jesus is Lord.jpg') }}" class="img-fluid rounded shadow"
                 style="max-height: 650px; object-fit: cover;"
                 alt="Church Image">
        </div>

        <!-- RIGHT SIDE FORM -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-light text-black p-4">
            <div class="w-100" style="max-width: 500px;">

                <div class="text-center mb-4">
                    <h2 class="fw-bold">Login to your Account</h2>
                    <p class="text-muted">Welcome back!</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email" required autofocus>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="mb-3 text-end">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                Forgot Password?
                            </a>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success w-100 py-2">
                        Login
                    </button>

                </form>

                <p class="text-center mt-4 mb-0">
                    Are you new here?
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        Register here
                    </a>
                </p>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
