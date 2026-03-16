<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sarua Connect')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .navbar {
            background: #FFFFFF;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
             position: sticky;
            top: 0;
            overflow: hidden;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            
        }

        .navbar-brand {
            color: #333;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .navbar-brand:hover {
            color: #d7df23;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .navbar-nav a {
            color: #000000;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .navbar-nav a:hover {
            background-color: #d7df23;
            color: #000000;
        }

        .container {
            max-width: 100%;
        
        }

        .card {
            background: white;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border: 1px solid #e1e5e9;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #d7df23;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #c5cd1f;
            box-shadow: 0 0 0 3px rgba(215, 223, 35, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #d7df23;
            color: #333;
            font-family: 'Inter', sans-serif;
        }

        .btn:hover {
            background: #c5cd1f;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(215, 223, 35, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 0 1rem;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 0.5rem;
            border: 2px solid #e9ecef;
        }

        .step.active .step-number {
            background: #d7df23;
            color: #333;
            border-color: #d7df23;
        }

        .step.completed .step-number {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        .step-title {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .step.active .step-title {
            color: #333;
            font-weight: 600;
        }

        .row {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .col-md-6 {
            flex: 1;
            min-width: 250px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: block;
            padding: 0.75rem;
            border: 2px dashed #d7df23;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .file-input-label:hover {
            border-color: #c5cd1f;
            background: #f0f8f0;
        }

        .text-center {
            text-align: center;
        }

        /* Password field with eye button styling */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-right: 3rem;
        }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 1.1rem;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .password-toggle:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }

            .container {
                padding: 0 1rem;
            }

            .row {
                flex-direction: column;
            }

            .step-indicator {
                flex-direction: column;
                gap: 0.5rem;
            }

            .step {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('sarua.png') }}" alt="Sarua Connect">
                
            </a>
            <ul class="navbar-nav">
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('my-profile') }}">My Profile</a></li>
                    <li><a href="{{ route('search') }}">Search</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: black; cursor: pointer; padding: 0.5rem 1rem;transition: all 0.3s ease;">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script>
      

        // Password visibility toggle functionality
        function togglePasswordVisibility(toggleBtn) {
            const passwordInput = toggleBtn.parentElement.querySelector('input[type="password"], input[type="text"]');
            const isPassword = passwordInput.type === 'password';
            
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleBtn.innerHTML = isPassword ? '❌' : '👁️';
            toggleBtn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
            toggleBtn.setAttribute('title', isPassword ? 'Hide password' : 'Show password');
        }

        // Accept connection request
        async function acceptConnection(connectionId) {
            try {
                const response = await fetch(`/connect/accept/${connectionId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    location.reload(); // Reload to update notifications
                } else {
                    alert('Failed to accept connection request');
                }
            } catch (error) {
                console.error('Error accepting connection:', error);
                alert('Network error. Please try again.');
            }
        }

        // Decline connection request
        async function declineConnection(connectionId) {
            try {
                const response = await fetch(`/connect/decline/${connectionId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    location.reload(); // Reload to update notifications
                } else {
                    alert('Failed to decline connection request');
                }
            } catch (error) {
                console.error('Error declining connection:', error);
                alert('Network error. Please try again.');
            }
        }
    </script>
</body>
</html>