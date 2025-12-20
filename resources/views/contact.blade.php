@extends('layouts.app')

@section('title', 'Contact Us - SkillBridge')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg mx-auto md:max-w-none md:grid md:grid-cols-2 md:gap-8">
            
            <!-- Contact Info -->
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white sm:text-3xl">
                    Get in Touch
                </h2>
                <div class="mt-3">
                    <p class="text-lg text-slate-500 dark:text-slate-400">
                        Have questions about joining SkillBridge? Want to explore a partnership? We'd love to hear from you.
                    </p>
                </div>
                <div class="mt-9">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="ml-3 text-base text-slate-500 dark:text-slate-400">
                            <p>+62 (821) 1234-5678</p>
                        </div>
                    </div>
                    <div class="mt-6 flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-3 text-base text-slate-500 dark:text-slate-400">
                            <p>support@skillbridge.org</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Connect on Social Media</h3>
                    <div class="flex gap-4">
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700 hover:bg-teal-100 dark:hover:bg-slate-600 text-slate-600 dark:text-white hover:text-teal-600 transition-all duration-300">
                            <!-- LinkedIn Icon (Simulated) -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700 hover:bg-teal-100 dark:hover:bg-slate-600 text-slate-600 dark:text-white hover:text-teal-600 transition-all duration-300">
                            <!-- Facebook Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 0v24h16v-24h-16zm8 22h-3v-10h-2.5v-3h2.5v-2c0-2.5 1.55-4.5 4.5-4.5 1.5 0 2.533.267 2.533.267v2.733h-1.55c-1.25 0-1.5.733-1.5 1.767v1.733h3.5l-.5 3h-3v10z"/></svg> 
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700 hover:bg-teal-100 dark:hover:bg-slate-600 text-slate-600 dark:text-white hover:text-teal-600 transition-all duration-300">
                            <!-- Instagram Icon -->
                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-200 dark:bg-slate-700 hover:bg-teal-100 dark:hover:bg-slate-600 text-slate-600 dark:text-white hover:text-teal-600 transition-all duration-300">
                             <!-- X (Twitter) Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                     </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="mt-12 md:mt-0">
                <form action="#" method="POST" class="grid grid-cols-1 gap-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Full Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" autocomplete="name" class="py-3 px-4 block w-full shadow-sm focus:ring-teal-500 focus:border-teal-500 border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm focus:ring-teal-500 focus:border-teal-500 border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md">
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Message</label>
                        <div class="mt-1">
                            <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-teal-500 focus:border-teal-500 border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md"></textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="w-full inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
