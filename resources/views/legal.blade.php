@extends('layouts.app')

@section('title', 'Legal - SkillBridge')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white sm:text-4xl">Legal Information</h1>
            <p class="mt-4 text-lg text-slate-600 dark:text-slate-400">Review our terms and policies</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Terms of Service (Left) -->
            <div id="terms" class="prose prose-lg dark:prose-invert max-w-none">
                <div class="border-b-2 border-slate-200 dark:border-slate-800 pb-4 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white m-0">Terms of Service</h2>
                    <p class="text-sm text-slate-500 mt-2">Last updated: {{ date('F j, Y') }}</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700">
                    <h3 class="text-teal-600 dark:text-teal-400 mt-0">1. Acceptance of Terms</h3>
                    <p>By accessing and using SkillBridge, you accept and agree to be bound by the terms and provision of this agreement.</p>
        
                    <h3 class="text-teal-600 dark:text-teal-400">2. Description of Service</h3>
                    <p>SkillBridge is a platform that connects volunteers with non-profit organizations for skills-based volunteering. We provide a platform for posting projects, discovering opportunities, and facilitating collaboration.</p>
        
                    <h3 class="text-teal-600 dark:text-teal-400">3. User Conduct</h3>
                    <p>You agree to use the site only for lawful purposed and in a way that does not infringe the rights of, restrict or inhibit anyone else's use and enjoyment of the site. Prohibited behavior includes harassing or causing distress or inconvenience to any other user, transmitting obscene or offensive content or disrupting the normal flow of dialogue within our website.</p>
        
                    <h3 class="text-teal-600 dark:text-teal-400">4. Intellectual Property</h3>
                    <p>The content, organization, graphics, design, compilation, magnetic translation, digital conversion and other matters related to the Site are protected under applicable copyrights, trademarks and other proprietary (including but not limited to intellectual property) rights.</p>
        
                    <h3 class="text-teal-600 dark:text-teal-400">5. Termination</h3>
                    <p>We may terminate your access to the Site, without cause or notice, which may result in the forfeiture and destruction of all information associated with you.</p>
                </div>
            </div>

            <!-- Privacy Policy (Right) -->
            <div id="privacy" class="prose prose-lg dark:prose-invert max-w-none">
                <div class="border-b-2 border-slate-200 dark:border-slate-800 pb-4 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white m-0">Privacy Policy</h2>
                    <p class="text-sm text-slate-500 mt-2">Last updated: {{ date('F j, Y') }}</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700">
                    <h3 class="text-teal-600 dark:text-teal-400 mt-0">1. Introduction</h3>
                    <p>Welcome to SkillBridge. We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you as to how we look after your personal data when you visit our website (regardless of where you visit it from) and tell you about your privacy rights and how the law protects you.</p>
        
                    <h3 class="text-teal-600 dark:text-teal-400">2. Data We Collect</h3>
                    <p>We may collect, use, store and transfer different kinds of personal data about you which we have grouped together follows:</p>
                    <ul class="list-disc pl-5 mb-4">
                        <li><strong>Identity Data</strong> includes first name, last name, username or similar identifier.</li>
                        <li><strong>Contact Data</strong> includes email address and telephone numbers.</li>
                        <li><strong>Profile Data</strong> includes your interests, preferences, feedback and survey responses.</li>
                    </ul>
        
                    <h3 class="text-teal-600 dark:text-teal-400">3. How We Use Your Data</h3>
                    <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:</p>
                    <ul class="list-disc pl-5 mb-4">
                        <li>Where we need to perform the contract we are about to enter into or have entered into with you.</li>
                        <li>Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.</li>
                    </ul>
        
                    <h3 class="text-teal-600 dark:text-teal-400">4. Data Security</h3>
                    <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorized way, altered or disclosed.</p>
        
                    <h3 class="text-teal-600 dark:text-teal-400">5. Contact Us</h3>
                    <p>If you have any questions about this privacy policy or our privacy practices, please contact us.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
