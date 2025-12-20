@extends('layouts.app')

@section('title', 'Partner Network - SkillBridge')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">Our Partner Network</h2>
        <p class="mt-4 text-lg text-slate-500 dark:text-slate-400">
            We collaborate with leading organizations to drive sustainable impact.
        </p>

        <div class="mt-16 grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-5">
            <div class="col-span-1 flex justify-center items-center py-8 px-8 bg-slate-50 dark:bg-slate-800 rounded-lg filter grayscale hover:grayscale-0 transition duration-300">
                 <img class="h-12 object-contain" src="https://ui-avatars.com/api/?name=Tech+For+Good&background=transparent&color=333" alt="Partner">
            </div>
            <div class="col-span-1 flex justify-center items-center py-8 px-8 bg-slate-50 dark:bg-slate-800 rounded-lg filter grayscale hover:grayscale-0 transition duration-300">
                 <img class="h-12 object-contain" src="https://ui-avatars.com/api/?name=Global+Impact&background=transparent&color=333" alt="Partner">
            </div>
            <div class="col-span-1 flex justify-center items-center py-8 px-8 bg-slate-50 dark:bg-slate-800 rounded-lg filter grayscale hover:grayscale-0 transition duration-300">
                 <img class="h-12 object-contain" src="https://ui-avatars.com/api/?name=UN+SDG&background=transparent&color=333" alt="Partner">
            </div>
            <div class="col-span-1 flex justify-center items-center py-8 px-8 bg-slate-50 dark:bg-slate-800 rounded-lg filter grayscale hover:grayscale-0 transition duration-300">
                 <img class="h-12 object-contain" src="https://ui-avatars.com/api/?name=Devs+Care&background=transparent&color=333" alt="Partner">
            </div>
            <div class="col-span-1 flex justify-center items-center py-8 px-8 bg-slate-50 dark:bg-slate-800 rounded-lg filter grayscale hover:grayscale-0 transition duration-300">
                 <img class="h-12 object-contain" src="https://ui-avatars.com/api/?name=Future+Now&background=transparent&color=333" alt="Partner">
            </div>
         </div>
    
         <div class="mt-16 bg-teal-700 rounded-2xl py-12 px-6 sm:px-12 lg:px-16 flex flex-col md:flex-row items-center justify-between">
             <div class="text-left mb-6 md:mb-0">
                 <h3 class="text-2xl font-bold text-white">Become a Corporate Partner</h3>
                 <p class="text-teal-100 mt-2">Engage your employees in meaningful corporate social responsibility (CSR) initiatives.</p>
             </div>
             <a href="{{ route('contact') }}" class="bg-white text-teal-700 font-bold py-3 px-8 rounded-lg shadow hover:bg-teal-50 transition">
                 Partner With Us
             </a>
         </div>
    </div>
</div>
@endsection
