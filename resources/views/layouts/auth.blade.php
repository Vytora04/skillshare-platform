<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkillBridge')</title>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow: hidden;
        }

        /* Blue gradient background matching SkillBridge theme */
        .auth-bg {
            background: linear-gradient(135deg, 
                #1e40af 0%,     /* Deep blue */
                #3b82f6 35%,    /* Blue */
                #60a5fa 70%,    /* Light blue */
                #93c5fd 100%    /* Very light blue */
            );
            position: relative;
            overflow: hidden;
        }

        /* Animated gradient overlay */
        .auth-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(59, 130, 246, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(236, 72, 153, 0.3) 0%, transparent 50%);
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        /* Decorative shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
            animation: float 20s ease-in-out infinite;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: rgba(59, 130, 246, 0.4);
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: rgba(236, 72, 153, 0.3);
            bottom: -150px;
            right: -150px;
            animation-delay: -5s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(50px, 50px); }
        }

        /* Modern white form container */
        .glass-box {
            background: #ffffff;
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            width: 520px;
            max-width: 90vw;
            border-radius: 24px;
        }

        /* Custom input styling */
        .input-box {
            position: relative;
            margin-bottom: 35px;
            width: 100%;
            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .form-title {
            color: #1f2937;
            margin-bottom: 40px !important;
        }

        .input-box input {
            width: 100%;
            background: rgba(59, 130, 246, 0.05);
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            color: #1f2937;
            font-size: 16px;
            padding: 14px 14px 14px 45px;
            outline: none;
            transition: 0.3s;
        }

        .input-box input:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .input-box input::placeholder {
            color: #9ca3af;
        }

        .input-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #6b7280;
        }

        /* Button styling */
        .btn-submit {
            width: 100%;
            max-width: 350px;
            height: 50px;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            display: block;
            margin: 0 auto;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
        }

        /* Remember & Forgot styling */
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            margin-top: 10px;
            font-size: 14px;
            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
        }

        .remember-forgot label {
            display: flex;
            align-items: center;
            color: #4b5563;
            cursor: pointer;
        }

        .remember-forgot input {
            margin-right: 8px;
            accent-color: #3b82f6;
        }

        .remember-forgot a {
            color: #3b82f6;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        .remember-forgot a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        /* Register/Login link */
        .logreg-link {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6b7280;
        }

        .logreg-link a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .logreg-link a:hover {
            color: #2563eb;
            text-decoration: underline;
        }
        
        .form-title {
            color: #1f2937;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex auth-bg">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        
        <!-- Left Side - Hero Section -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center relative z-10 px-16">
            <div class="text-white space-y-6 max-w-xl">
                <div class="flex items-center gap-3 mb-8">
                    <i class='bx bxs-hand-right text-6xl'></i>
                    <h1 class="text-5xl font-bold">SkillBridge</h1>
                </div>
                
                <h2 class="text-5xl font-bold leading-tight">
                    Welcome!<br>
                    <span class="text-blue-200">To Our Platform.</span>
                </h2>
                
                <p class="text-lg text-white/90 leading-relaxed">
                    Connect with changemakers, NGOs, and volunteers to collaborate on social-impact projects that matter.
                </p>
                
                <!-- Social Icons -->
                <div class="flex gap-4 pt-6">
                    <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-linkedin text-2xl'></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-facebook text-2xl'></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-instagram text-2xl'></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-twitter text-2xl'></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center relative z-10 p-8">
            @yield('form-content')
        </div>
    </div>
</body>
</html>
