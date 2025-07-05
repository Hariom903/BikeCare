<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F9FA;
        }
        .login-box {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 15px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            color: purple;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1 class="text-center mb-4">Login User:)   </h1>
            <form action="{{ route('login.user') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" >
                    @error('email')
              <div class="error"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" >
                     @error('password')
              <div class="error"> {{ $message }} </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>

            </form>
        </div>
    </div>
</body>
</html>
