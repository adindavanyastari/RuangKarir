@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen bg-gradient-to-br from-gray-50 via-white to-orange-50 overflow-hidden">
    <!-- Subtle Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-64 h-64 bg-orange-100 rounded-full opacity-10 blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-200 rounded-full opacity-10 blur-3xl"></div>
    </div>

    <!-- Sign In/Sign Up Buttons -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 pt-6">
        <div class="flex justify-end space-x-4">
            <a href="{{ route('login') }}" 
               class="px-6 py-2.5 text-sm font-medium text-gray-700 hover:text-orange-600 bg-white border border-gray-200 rounded-lg hover:border-orange-300 transition-all duration-300 shadow-sm hover:shadow-md">
                Sign In
            </a>
            <a href="{{ route('register') }}" 
               class="px-6 py-2.5 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                Get Started
            </a>
        </div>
    </div>

    <!-- Main Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-20 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Content -->
            <div class="text-center lg:text-left">
                <div class="mb-8">
                    <span class="inline-block px-4 py-2 bg-orange-50 text-orange-600 rounded-full text-sm font-medium border border-orange-100">
                        Exclusive Platform for UISI Students
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-8 leading-tight">
                    Build Your 
                    <span class="text-orange-500 relative">
                        Professional
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-orange-200" viewBox="0 0 200 12" fill="currentColor">
                            <path d="M0,8 Q50,0 100,4 T200,6 L200,12 L0,12 Z" opacity="0.8"/>
                        </svg>
                    </span>
                    <br>Career Journey
                </h1>
                
                <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-xl">
                    Connect with top companies, discover exclusive internship opportunities, and accelerate your career growth with our comprehensive platform designed specifically for UISI students.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-12">
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Start Your Journey
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('peluang') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-orange-300 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Explore Opportunities
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 text-center lg:text-left">
                    <div>
                        <div class="text-3xl font-bold text-orange-500 mb-1">500+</div>
                        <div class="text-sm text-gray-600 font-medium">Active Students</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-orange-500 mb-1">150+</div>
                        <div class="text-sm text-gray-600 font-medium">Job Opportunities</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-orange-500 mb-1">75+</div>
                        <div class="text-sm text-gray-600 font-medium">Partner Companies</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Hero Image -->
            <div class="relative">
                <div class="relative bg-white rounded-2xl shadow-2xl p-8 transform hover:scale-105 transition-transform duration-500">
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6">
                        <!-- Hero Image -->
                        <div class="w-full h-80 bg-gray-100 rounded-lg overflow-hidden mb-6">
                            <img src="/images/welcome.png" 
                                 alt="Professional Career Development" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Achievement indicators -->
                        <div class="flex justify-center space-x-6">
                            <div class="bg-white rounded-full p-4 shadow-md">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="bg-white rounded-full p-4 shadow-md">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                </svg>
                            </div>
                            <div class="bg-white rounded-full p-4 shadow-md">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating elements -->
                <div class="absolute -top-4 -left-4 bg-orange-400 rounded-full p-3 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <div class="absolute -bottom-4 -right-4 bg-orange-500 rounded-full p-3 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Why Choose Ruang Karir?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Our platform provides comprehensive tools and resources designed specifically for UISI students to excel in their professional journey.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Feature 1 -->
            <div class="text-center group">
                <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 transition-colors duration-300">
                    <svg class="w-8 h-8 text-orange-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Exclusive Opportunities</h3>
                <p class="text-gray-600 leading-relaxed">
                    Access to premium internship and job opportunities exclusively available for UISI students from top-tier companies.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center group">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-500 transition-colors duration-300">
                    <svg class="w-8 h-8 text-blue-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Professional Network</h3>
                <p class="text-gray-600 leading-relaxed">
                    Connect with fellow students, alumni, and industry professionals to expand your network and career opportunities.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center group">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-500 transition-colors duration-300">
                    <svg class="w-8 h-8 text-green-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Career Development</h3>
                <p class="text-gray-600 leading-relaxed">
                    Comprehensive tools and resources to build your professional profile, enhance skills, and track your career progress.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 lg:py-28 bg-gradient-to-r from-orange-500 to-orange-600">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Ready to Accelerate Your Career?
        </h2>
        <p class="text-xl text-orange-100 mb-10 leading-relaxed">
            Join thousands of UISI students who have already started their professional journey with us. Your dream career is just one click away.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-gray-100 text-orange-600 font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                Get Started Today
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
            <a href="{{ route('about') }}" 
               class="inline-flex items-center justify-center px-8 py-4 bg-transparent hover:bg-orange-400 text-white font-semibold rounded-xl border-2 border-white hover:border-orange-400 transition-all duration-300">
                Learn More About Us
            </a>
        </div>
    </div>
</div>
@endsection
