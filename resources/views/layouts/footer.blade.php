<footer class="bg-slate-900 text-slate-300 py-16 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6 text-2xl font-bold text-white">
                    <img src="{{ asset('images/SkillBridge Logo.png') }}" alt="SkillBridge Logo" class="h-10 w-auto">
                    SkillBridge
                </a>
                <p class="text-slate-400 leading-relaxed max-w-sm">
                    Bridge the gap between professional expertise and social impact. We empower you to use your skills for causes that matter.
                </p>
            </div>

            <!-- Discover Links -->
            <div>
                <h4 class="text-white font-bold mb-6">Discover</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('mission') }}" class="text-slate-400 hover:text-teal-400 transition">Our Mission</a></li>
                    <li><a href="{{ route('ngos') }}" class="text-slate-400 hover:text-teal-400 transition">For NGOs</a></li>
                    <li><a href="{{ route('volunteers') }}" class="text-slate-400 hover:text-teal-400 transition">Volunteer Series</a></li>
                </ul>
            </div>

            <!-- Impact Links -->
            <div>
                <h4 class="text-white font-bold mb-6">Impact</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('partners') }}" class="text-slate-400 hover:text-teal-400 transition">Partner Network</a></li>
                    <li><a href="{{ route('contact') }}" class="text-slate-400 hover:text-teal-400 transition">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-slate-800 pt-8 mt-12 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} SkillBridge. All rights reserved.</p>
            <div class="flex gap-6 text-sm text-slate-500">
                <a href="{{ route('about') }}" class="hover:text-teal-400 transition">About Us</a>
                <a href="{{ route('legal') }}" class="hover:text-teal-400 transition">Privacy & Terms</a>
            </div>
        </div>
    </div>
</footer>
