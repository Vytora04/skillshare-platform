@extends('layouts.app')

@section('title', 'Volunteer Series - SkillBridge')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white sm:text-4xl text-center mb-12">
            Volunteer Series: Stories of Impact
        </h1>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- Article 1 -->
            <article class="flex flex-col overflow-hidden rounded-lg shadow-lg dark:bg-slate-800">
                <div class="flex-shrink-0">
                    <div class="h-48 w-full bg-slate-300 dark:bg-slate-700 flex items-center justify-center">
                        <svg class="h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <div class="flex flex-1 flex-col justify-between p-6">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-teal-600 dark:text-teal-400">
                            Success Story
                        </p>
                        <a href="#" class="mt-2 block">
                            <p class="text-xl font-semibold text-slate-900 dark:text-white">
                                How Sarah Built a Funding Strategy for Local Schools
                            </p>
                            <p class="mt-3 text-base text-slate-500 dark:text-slate-400">
                                Sarah, a financial analyst, spent 5 hours a week helping an education NGO restructure their budget. The result? A 20% increase in grant approvals.
                            </p>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="flex flex-col overflow-hidden rounded-lg shadow-lg dark:bg-slate-800">
                <div class="flex-shrink-0">
                    <div class="h-48 w-full bg-slate-300 dark:bg-slate-700 flex items-center justify-center">
                        <svg class="h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <div class="flex flex-1 flex-col justify-between p-6">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-teal-600 dark:text-teal-400">
                            Guide
                        </p>
                        <a href="#" class="mt-2 block">
                            <p class="text-xl font-semibold text-slate-900 dark:text-white">
                                5 Tips for First-Time Skill Volunteers
                            </p>
                            <p class="mt-3 text-base text-slate-500 dark:text-slate-400">
                                Starting your first pro-bono project? Here are the essential tips to manage expectations and deliver value effectively.
                            </p>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="flex flex-col overflow-hidden rounded-lg shadow-lg dark:bg-slate-800">
                <div class="flex-shrink-0">
                    <div class="h-48 w-full bg-slate-300 dark:bg-slate-700 flex items-center justify-center">
                        <svg class="h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <div class="flex flex-1 flex-col justify-between p-6">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-teal-600 dark:text-teal-400">
                            Interview
                        </p>
                        <a href="#" class="mt-2 block">
                            <p class="text-xl font-semibold text-slate-900 dark:text-white">
                                Q&A with the Founder of GreenLife
                            </p>
                            <p class="mt-3 text-base text-slate-500 dark:text-slate-400">
                                We sat down with Marcus to discuss how technology is enabling his team to reforest the Amazon more efficiently.
                            </p>
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
