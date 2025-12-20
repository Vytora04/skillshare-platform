@extends('layouts.app')

@section('title', 'Our Mission - SkillBridge')

@section('content')
<div>
    <div class="relative bg-teal-900 py-16 sm:py-24">
        <div class="absolute inset-0 overflow-hidden">
             <div class="absolute inset-0 bg-teal-900 mix-blend-multiply"></div>
             <div class="absolute inset-0 bg-gradient-to-t from-teal-900 via-teal-900/40"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Our Mission</h1>
            <p class="mt-6 text-xl text-teal-100 max-w-3xl mx-auto">
                To democratize access to expertise and accelerate social impact through skills-based volunteering.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="prose dark:prose-invert max-w-none">
            <p class="lead text-xl text-slate-600 dark:text-slate-300">
                SkillBridge was founded on a simple belief: <strong>talent is universal, but opportunity is not.</strong> We see a world where non-profits and social enterprises often lack the resources to hire top-tier talent, while professionals everywhere are looking for more meaningful ways to give back than just writing a check.
            </p>
            
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-12 mb-4">The Gap We Bridge</h3>
            <p>
                Thousands of organizations are working tirelessly to solve humanity's biggest challenges—from climate change to education inequality. Yet, they often struggle with operational bottlenecks in technology, marketing, strategy, and finance.
            </p>
            <p>
                At the same time, millions of skilled professionals want to contribute their expertise but struggle to find opportunities that fit their skills and schedule. SkillBridge creates the connection that unlocks this potential.
            </p>

            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-12 mb-4">Our Core Values</h3>
            <div class="grid md:grid-cols-3 gap-8 not-prose mt-8">
                <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Impact First</h4>
                    <p class="text-slate-600 dark:text-slate-400">We prioritize outcomes that drive real change for beneficiaries.</p>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Community</h4>
                    <p class="text-slate-600 dark:text-slate-400">We build meaningful relationships based on trust and mutual respect.</p>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-xl">
                    <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center mb-4">
                         <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Excellence</h4>
                    <p class="text-slate-600 dark:text-slate-400">We strive for high-quality results in every project.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
