@extends('layouts.app')

@section('title', 'For NGOs - SkillBridge')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-teal-600 dark:text-teal-400 tracking-wide uppercase">Non-Profits & Social Enterprises</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                Amplify Your Impact with Expert Support
            </p>
            <p class="mt-4 max-w-2xl text-xl text-slate-500 dark:text-slate-400 mx-auto">
                Get pro-bono support from professionals in tech, marketing, finance, and strategy to help your organization scale.
            </p>
        </div>

        <div class="mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">How It Works</h3>
                    <ol class="relative border-l border-slate-200 dark:border-slate-700 ml-4">                  
                        <li class="mb-10 ml-6">            
                            <span class="absolute flex items-center justify-center w-8 h-8 bg-teal-100 dark:bg-teal-900 rounded-full -left-4 ring-8 ring-white dark:ring-slate-900">
                                <span class="font-bold text-teal-600 dark:text-teal-400">1</span>
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-slate-900 dark:text-white">Post a Project</h3>
                            <p class="mb-4 text-base font-normal text-slate-500 dark:text-slate-400">Describe your needs, whether it's a website redesign, a fundraising strategy, or legal advice.</p>
                        </li>
                        <li class="mb-10 ml-6">
                            <span class="absolute flex items-center justify-center w-8 h-8 bg-teal-100 dark:bg-teal-900 rounded-full -left-4 ring-8 ring-white dark:ring-slate-900">
                                <span class="font-bold text-teal-600 dark:text-teal-400">2</span>
                            </span>
                            <h3 class="mb-1 text-lg font-semibold text-slate-900 dark:text-white">Match with Experts</h3>
                            <p class="text-base font-normal text-slate-500 dark:text-slate-400">Our algorithm matches you with vetted professionals who have the skills you need.</p>
                        </li>
                        <li class="ml-6">
                            <span class="absolute flex items-center justify-center w-8 h-8 bg-teal-100 dark:bg-teal-900 rounded-full -left-4 ring-8 ring-white dark:ring-slate-900">
                                <span class="font-bold text-teal-600 dark:text-teal-400">3</span>
                            </span>
                            <h3 class="mb-1 text-lg font-semibold text-slate-900 dark:text-white">Collaborate & Grow</h3>
                            <p class="text-base font-normal text-slate-500 dark:text-slate-400">Manage the project through our platform and focus on delivering your mission.</p>
                        </li>
                    </ol>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 text-center">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Ready to get started?</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-8">
                        Join hundreds of organizations transforming their operations with SkillBridge.
                    </p>
                    <a href="{{ route('register') }}" class="inline-block bg-teal-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-teal-700 transition w-full">
                        Register Your Organization
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
