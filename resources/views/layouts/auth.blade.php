<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkillBridge')</title>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('images/SkillBridge Logo.png') }}" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        /* Green/Slate gradient background matching SkillBridge theme */
        .auth-bg {
            background: linear-gradient(135deg, 
                #020617 0%,     /* Slate 950 */
                #0f172a 40%,    /* Slate 900 */
                #115e59 80%,    /* Teal 800 */
                #0d9488 100%    /* Teal 600 */
            );
            position: relative;
            min-height: 100vh;
            width: 100%;
        }

        /* Animated gradient overlay */
        .auth-bg::before {
            content: '';
            position: fixed; /* Fixed so it stays while scrolling */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(13, 148, 136, 0.2) 0%, transparent 50%),
                        radial-gradient(circle at 70% 80%, rgba(16, 185, 129, 0.2) 0%, transparent 50%);
            animation: gradientShift 10s ease infinite;
            pointer-events: none;
        }

        @keyframes gradientShift {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        /* Decorative shapes */
        .shape {
            position: fixed; /* Fixed so they stay while scrolling */
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
            animation: float 20s ease-in-out infinite;
            z-index: 0;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: rgba(13, 148, 136, 0.3); /* Teal */
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: rgba(16, 185, 129, 0.2); /* Emerald */
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            width: 500px;
            max-width: 95vw;
            min-height: 700px;
            border-radius: 24px;
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centered content vertically */
        }

        /* Floating Label & New Input Styles */
        .input-group {
            position: relative;
            margin-bottom: 18px; /* Reduced gap to 18px */
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .input-field {
            width: 100%;
            height: 50px; /* Explicit height for consistency */
            padding: 0 16px 0 50px; /* Remove vertical padding, rely on height/line-height */
            line-height: 46px; /* Vertically center text (50px - 4px border) */
            font-size: 15px;
            color: #1f2937;
            background: rgba(255, 255, 255, 0.7);
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #0d9488;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 25px; /* Fixed center position relative to input height */
            transform: translateY(-50%);
            font-size: 20px;
            color: #94a3b8;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .input-field:focus ~ .input-icon {
            color: #0d9488;
        }

        /* Floating Label */
        .floating-label {
            position: absolute;
            left: 48px;
            top: 25px; /* Fixed center position relative to input height */
            transform: translateY(-50%);
            background: transparent;
            padding: 0 4px;
            color: #64748b;
            font-size: 15px;
            pointer-events: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .input-field:focus ~ .floating-label,
        .input-field:not(:placeholder-shown) ~ .floating-label {
            top: 0;
            left: 20px;
            font-size: 12px;
            color: #0d9488;
            background: #ffffff;
            padding: 0 8px;
            border-radius: 4px;
            transform: translateY(-50%);
        }
        
        /* Password Strength Meter */
        .strength-meter {
            height: 4px;
            width: 100%;
            background: #e2e8f0;
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
            display: none;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        /* Role Selection Cards */
        .role-card-input {
            display: none;
        }

        .role-wrapper {
            margin-bottom: 24px;
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .role-card {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.7);
        }

        .role-card:hover {
            border-color: #99f6e4;
            background: #f0fdfa;
        }

        .role-card-input:checked + .role-card {
            border-color: #0d9488;
            background: #effcf9;
            box-shadow: 0 4px 6px -1px rgba(13, 148, 136, 0.1);
        }

        .role-icon {
            font-size: 28px;
            color: #cbd5e1;
            margin-bottom: 4px;
            transition: color 0.3s;
        }

        .role-card-input:checked + .role-card .role-icon {
            color: #0d9488;
        }

        .role-title {
            font-weight: 600;
            color: #334155;
            font-size: 13px;
        }
        
        .form-title {
            color: #0f172a;
            position: relative;
            padding-bottom: 4px; /* Tiny gap */
        }

        /* Centered Elements */
        .remember-forgot, .btn-submit, .logreg-link {
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
        
        .remember-forgot {
            margin-bottom: 24px; /* Space for checkbox */
        }
        
        .btn-submit {
            display: block;
            margin-top: 10px;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.3);
            font-weight: 600;
        }
        
        .logreg-link {
            margin-top: 24px;
            font-size: 14px;
        }
        
        .logreg-link a {
            color: #0d9488;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .logreg-link a:hover {
            color: #0f766e;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col lg:flex-row auth-bg relative">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        
        <!-- Left Side - Hero Section -->
        <div class="hidden lg:flex lg:w-1/2 flex-col items-center justify-center relative z-10 px-16 min-h-screen">
            <!-- Content Wrapper to restore pointer events -->
            <div class="pointer-events-auto max-w-xl text-white space-y-6">
                <div class="flex items-center gap-3 mb-8">
                    <img src="{{ asset('images/SkillBridge Logo.png') }}" alt="SkillBridge Logo" class="h-16 w-auto">
                    <h1 class="text-5xl font-bold">SkillBridge</h1>
                </div>
                
                <h2 class="text-5xl font-bold leading-tight">
                    Welcome!<br>
                    <span class="text-teal-200">To Our Platform.</span>
                </h2>
                
                <p class="text-lg text-white/90 leading-relaxed">
                    Connect with changemakers, NGOs, and volunteers to collaborate on social-impact projects that matter.
                </p>
                
                <!-- Social Icons -->
                <div class="flex gap-4 pt-6">
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-linkedin text-2xl'></i>
                    </a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-facebook text-2xl'></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <i class='bx bxl-instagram text-2xl'></i>
                    </a>
                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-all duration-300 hover:scale-110">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center relative z-10 py-12 px-4 sm:px-8">
            @yield('form-content')
        </div>
    </div>
</body>
</html>
