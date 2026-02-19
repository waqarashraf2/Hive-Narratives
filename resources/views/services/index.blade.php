@extends('layouts.app')

@section('title', 'Enterprise Solutions - HiveNarratives')
@section('meta-description', 'Professional graphic design, AutoCat content, and video editing services for enterprise businesses.')
@section('meta-keywords', 'enterprise solutions, graphic design, video editing, AutoCat, business services')

@section('content')
<!-- Hero Section with Three.js Canvas -->
<div class="relative bg-white dark:bg-gray-900 min-h-screen flex items-center overflow-hidden">
    <!-- Three.js Canvas Background -->
    <div id="canvas-container" class="absolute inset-0 z-0"></div>
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-white/90 via-white/50 to-transparent dark:from-gray-900/90 dark:via-gray-900/50 z-10"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20 py-20 sm:py-24 lg:py-32">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Animated Badge -->
            <div class="inline-flex items-center bg-purple-50 dark:bg-gray-800 text-purple-600 dark:text-purple-400 px-4 py-2 rounded-full mb-6 border border-purple-100 dark:border-gray-700 animate-fade-in">
                <i class="fas fa-crown text-sm sm:text-base mr-2"></i>
                <span class="text-xs sm:text-sm font-medium">Enterprise-Grade Solutions</span>
            </div>
            
            <!-- Main Heading with Animation -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight animate-slide-up">
                Transform Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Enterprise</span> with Creative Excellence
            </h1>
            
            <!-- Subheading -->
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto animate-slide-up-delay">
                We deliver premium graphic design, automotive content, and video editing solutions that elevate enterprise brands and drive business growth.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up-delay-2">
                <button onclick="scrollToServices()" class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-xl text-sm sm:text-base transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                    <i class="fas fa-compass mr-2 group-hover:rotate-12 transition-transform"></i>
                    Explore Solutions
                </button>
                
                <a href="https://wa.me/923211417347?text=Hi! I'm interested in your enterprise solutions." 
                   target="_blank"
                   class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-white font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-xl text-sm sm:text-base transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                    <i class="fab fa-whatsapp mr-2 group-hover:rotate-12 transition-transform"></i>
                    Consult Enterprise
                </a>
            </div>
            
            <!-- Enterprise Trust Indicators -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 mt-12 sm:mt-16 animate-fade-in">
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">10+</div>
                    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Years Enterprise Experience</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">150+</div>
                    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Enterprise Clients</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">500+</div>
                    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Projects Delivered</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">24/7</div>
                    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Enterprise Support</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
        <div class="w-6 h-10 border-2 border-gray-400 dark:border-gray-600 rounded-full flex justify-center">
            <div class="w-1 h-2 bg-purple-600 rounded-full mt-2 animate-scroll"></div>
        </div>
    </div>
</div>

<!-- Main Services Section -->
<div id="services" class="bg-gray-50 dark:bg-gray-800 py-16 sm:py-20 lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
            <span class="text-purple-600 dark:text-purple-400 font-semibold text-xs sm:text-sm tracking-wider uppercase">Enterprise Solutions</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mt-2 mb-4">Comprehensive Creative Services for Your Business</h2>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300">Tailored solutions that help enterprise businesses communicate, engage, and grow.</p>
        </div>
        
        <!-- Graphic Design Section -->
        <div class="mb-16 sm:mb-20 lg:mb-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 sm:mb-10">
                <div class="flex items-center mb-3 sm:mb-0">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-pencil-ruler text-xl sm:text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">Enterprise Graphic Design</h3>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Premium visual solutions for enterprise brands</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Brand Identity Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-brush text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Enterprise Brand Identity</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Complete brand identity systems for enterprise businesses including logos, color palettes, typography, and brand guidelines.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Logo Design & Variations</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Brand Guidelines Document</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Stationery & Marketing Materials</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$1,999+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Enterprise Brand Identity service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Marketing Collateral Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-file-alt text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Enterprise Marketing Collateral</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Professional brochures, catalogs, presentations, and sales materials that impress enterprise clients.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Corporate Brochures & Catalogs</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Presentation Decks</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Annual Reports</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$2,499+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Enterprise Marketing Collateral service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Digital Assets Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-laptop text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Enterprise Digital Assets</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Social media templates, email designs, web graphics, and digital advertising materials.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Social Media Templates</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Email Newsletter Designs</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Web & Mobile Graphics</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$1,499+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Enterprise Digital Assets service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- AutoCat Enterprise Section -->
        <div class="mb-16 sm:mb-20 lg:mb-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 sm:mb-10">
                <div class="flex items-center mb-3 sm:mb-0">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-building text-xl sm:text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">AutoCat Enterprise Solutions</h3>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Automotive content for industry leaders</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Dealer Content Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-car text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Dealership Content Suite</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Complete content packages for automotive dealerships including vehicle descriptions, blog posts, and marketing copy.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Vehicle Inventory Descriptions</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Dealership Blog Content</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>SEO-Optimized Listings</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$2,999+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Dealership Content Suite service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Manufacturer Content Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-industry text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Manufacturer Content Solutions</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Technical documentation, white papers, and industry reports for automotive manufacturers.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Technical Documentation</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Industry White Papers</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Product Catalogs</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$3,999+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Manufacturer Content Solutions service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Aftermarket Content Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-tools text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Aftermarket Content Suite</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Parts catalogs, installation guides, and technical content for aftermarket automotive companies.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Parts Catalogs</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Installation Guides</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Technical Specifications</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$2,499+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Aftermarket Content Suite service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Video Editing Section -->
        <div class="mb-16 sm:mb-20 lg:mb-24">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 sm:mb-10">
                <div class="flex items-center mb-3 sm:mb-0">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-video text-xl sm:text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">Enterprise Video Production</h3>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Professional video content for corporate communications</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Corporate Videos Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-building text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Corporate Video Production</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Brand films, company culture videos, and corporate communications for enterprise businesses.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Brand Story Films</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Company Culture Videos</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Executive Messages</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$3,999+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Corporate Video Production service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Product Videos Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-box text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Product Video Production</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Product demos, explainer videos, and promotional content for enterprise products.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Product Demos</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Explainer Videos</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Promotional Content</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$2,999+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Product Video Production service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Training Videos Card -->
                <div class="service-card bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden group">
                    <div class="p-6 sm:p-8">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-chalkboard-teacher text-xl sm:text-2xl text-white"></i>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-2 sm:mb-3">Corporate Training Videos</h4>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mb-4 sm:mb-6">Employee training, onboarding, and educational content for enterprise organizations.</p>
                        <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Employee Training Modules</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Onboarding Videos</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span>Educational Content</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl sm:text-2xl font-bold text-purple-600 dark:text-purple-400">$3,499+</span>
                            <a href="https://wa.me/923211417347?text=Hi! I'm interested in your Corporate Training Videos service" 
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium transition-all transform hover:scale-105 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Inquire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enterprise Features -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 shadow-xl mt-8 sm:mt-12">
            <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-center text-gray-900 dark:text-white mb-8 sm:mb-10">Why Enterprise Businesses Choose Us</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="text-center group">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-alt text-2xl sm:text-3xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm sm:text-base mb-1">Enterprise Security</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">NDA protection and secure file transfer</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-pink-100 dark:bg-pink-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-clock text-2xl sm:text-3xl text-pink-600 dark:text-pink-400"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm sm:text-base mb-1">Dedicated Teams</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">24/7 support with dedicated project managers</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-orange-100 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-line text-2xl sm:text-3xl text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm sm:text-base mb-1">Scalable Solutions</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">Services that grow with your business</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mx-auto mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-certificate text-2xl sm:text-3xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white text-sm sm:text-base mb-1">ISO Certified</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">Quality management certified processes</p>
                </div>
            </div>
        </div>
        
        <!-- Our Process Section -->
        <div class="mt-16 sm:mt-20 lg:mt-24">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <span class="text-purple-600 dark:text-purple-400 font-semibold text-xs sm:text-sm tracking-wider uppercase">Our Methodology</span>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mt-2 mb-4">How We Deliver Enterprise Excellence</h3>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300">A proven process that ensures quality, consistency, and results for your business.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="process-step text-center">
                    <div class="relative">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white text-2xl sm:text-3xl font-bold">1</div>
                        <div class="absolute top-1/2 left-full w-full h-0.5 bg-gradient-to-r from-purple-600 to-transparent hidden lg:block"></div>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">Discovery</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">We analyze your business needs, goals, and target audience to create a tailored strategy.</p>
                </div>
                
                <div class="process-step text-center">
                    <div class="relative">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white text-2xl sm:text-3xl font-bold">2</div>
                        <div class="absolute top-1/2 left-full w-full h-0.5 bg-gradient-to-r from-purple-600 to-transparent hidden lg:block"></div>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">Strategy</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">We develop a comprehensive plan with timelines, milestones, and deliverables.</p>
                </div>
                
                <div class="process-step text-center">
                    <div class="relative">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white text-2xl sm:text-3xl font-bold">3</div>
                        <div class="absolute top-1/2 left-full w-full h-0.5 bg-gradient-to-r from-purple-600 to-transparent hidden lg:block"></div>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">Execution</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">Our expert team delivers high-quality work with regular updates and reviews.</p>
                </div>
                
                <div class="process-step text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white text-2xl sm:text-3xl font-bold">4</div>
                    <h4 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">Optimization</h4>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300">We refine and optimize based on feedback and performance metrics.</p>
                </div>
            </div>
        </div>
        
        <!-- Enterprise CTA -->
        <div class="mt-16 sm:mt-20 lg:mt-24">
            <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-orange-600 rounded-2xl sm:rounded-3xl p-8 sm:p-12 lg:p-16 text-center relative overflow-hidden">
                <!-- Animated Background Elements -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl animate-pulse animation-delay-1000"></div>
                </div>
                
                <div class="relative z-10">
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-4">Ready to Transform Your Enterprise?</h3>
                    <p class="text-sm sm:text-base lg:text-lg text-white/90 mb-8 max-w-2xl mx-auto">Get a customized enterprise solution tailored to your business needs.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="https://wa.me/923211417347?text=Hi! I'm interested in enterprise solutions for my business." 
                           target="_blank"
                           class="w-full sm:w-auto bg-white text-purple-600 hover:bg-gray-100 font-bold py-3 sm:py-4 px-6 sm:px-8 rounded-xl text-sm sm:text-base transition-all transform hover:scale-105 shadow-xl flex items-center justify-center group">
                            <i class="fab fa-whatsapp mr-2 text-green-500 text-lg group-hover:rotate-12 transition-transform"></i>
                            Schedule Enterprise Consultation
                        </a>
                        
                        <button onclick="scrollToTop()" 
                                class="w-full sm:w-auto bg-transparent hover:bg-white/10 text-white font-bold py-3 sm:py-4 px-6 sm:px-8 rounded-xl text-sm sm:text-base transition-all border-2 border-white/50 hover:border-white flex items-center justify-center">
                            <i class="fas fa-arrow-up mr-2"></i>
                            Back to Top
                        </button>
                    </div>
                    
                    <div class="mt-6 inline-flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                        <i class="fas fa-bolt text-yellow-300 mr-2 text-xs sm:text-sm"></i>
                        <span class="text-white text-xs sm:text-sm">Enterprise response within 1 hour</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/923211417347" 
   target="_blank" 
   class="fixed bottom-4 sm:bottom-6 right-4 sm:right-6 bg-gradient-to-r from-green-500 to-green-600 text-white p-3 sm:p-4 rounded-full shadow-2xl hover:shadow-green-500/50 hover:scale-110 transition-all z-50 flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 group animate-float"
   aria-label="Chat on WhatsApp">
    <i class="fab fa-whatsapp text-xl sm:text-2xl group-hover:rotate-12 transition-transform"></i>
    <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5 sm:h-3 sm:w-3">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2.5 w-2.5 sm:h-3 sm:w-3 bg-green-500"></span>
    </span>
</a>

<!-- Three.js Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<!-- GSAP Animation Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
// Three.js Setup
const container = document.getElementById('canvas-container');
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });

renderer.setSize(window.innerWidth, window.innerHeight);
renderer.setPixelRatio(window.devicePixelRatio);
container.appendChild(renderer.domElement);

// Create floating particles
const particlesGeometry = new THREE.BufferGeometry();
const particlesCount = 1000;
const posArray = new Float32Array(particlesCount * 3);

for(let i = 0; i < particlesCount * 3; i += 3) {
    posArray[i] = (Math.random() - 0.5) * 20;
    posArray[i+1] = (Math.random() - 0.5) * 20;
    posArray[i+2] = (Math.random() - 0.5) * 20;
}

particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

// Create gradient spheres
const particlesMaterial = new THREE.PointsMaterial({
    size: 0.05,
    color: 0x8b5cf6,
    transparent: true,
    opacity: 0.6,
    blending: THREE.AdditiveBlending
});

const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
scene.add(particlesMesh);

// Create central geometric shapes
const geometry1 = new THREE.IcosahedronGeometry(1, 0);
const material1 = new THREE.MeshPhongMaterial({
    color: 0x8b5cf6,
    emissive: 0x4c1d95,
    shininess: 30,
    transparent: true,
    opacity: 0.3,
    wireframe: true
});
const shape1 = new THREE.Mesh(geometry1, material1);
scene.add(shape1);

const geometry2 = new THREE.TorusKnotGeometry(0.8, 0.3, 100, 16);
const material2 = new THREE.MeshPhongMaterial({
    color: 0xec4899,
    emissive: 0x831843,
    shininess: 30,
    transparent: true,
    opacity: 0.2,
    wireframe: true
});
const shape2 = new THREE.Mesh(geometry2, material2);
scene.add(shape2);

// Add lights
const light1 = new THREE.PointLight(0x8b5cf6, 1);
light1.position.set(2, 2, 2);
scene.add(light1);

const light2 = new THREE.PointLight(0xec4899, 1);
light2.position.set(-2, -2, 2);
scene.add(light2);

const ambientLight = new THREE.AmbientLight(0x404040);
scene.add(ambientLight);

camera.position.z = 5;

// Mouse interaction
let mouseX = 0;
let mouseY = 0;

document.addEventListener('mousemove', (event) => {
    mouseX = (event.clientX / window.innerWidth - 0.5) * 2;
    mouseY = (event.clientY / window.innerHeight - 0.5) * 2;
});

// Animation loop
function animate() {
    requestAnimationFrame(animate);
    
    // Rotate shapes
    shape1.rotation.x += 0.001;
    shape1.rotation.y += 0.002;
    shape2.rotation.x += 0.002;
    shape2.rotation.y += 0.001;
    
    // Rotate particles
    particlesMesh.rotation.y += 0.0005;
    
    // Mouse follow
    shape1.position.x += (mouseX * 0.5 - shape1.position.x) * 0.02;
    shape1.position.y += (-mouseY * 0.5 - shape1.position.y) * 0.02;
    shape2.position.x += (mouseX * 0.3 - shape2.position.x) * 0.02;
    shape2.position.y += (-mouseY * 0.3 - shape2.position.y) * 0.02;
    
    renderer.render(scene, camera);
}

animate();

// Handle resize
window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

// GSAP Animations
document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);
    
    // Hero animations
    gsap.from('.animate-fade-in', {
        opacity: 0,
        y: 20,
        duration: 1,
        ease: 'power3.out'
    });
    
    gsap.from('.animate-slide-up', {
        opacity: 0,
        y: 50,
        duration: 1,
        delay: 0.2,
        ease: 'power3.out'
    });
    
    gsap.from('.animate-slide-up-delay', {
        opacity: 0,
        y: 50,
        duration: 1,
        delay: 0.4,
        ease: 'power3.out'
    });
    
    gsap.from('.animate-slide-up-delay-2', {
        opacity: 0,
        y: 50,
        duration: 1,
        delay: 0.6,
        ease: 'power3.out'
    });
    
    // Service cards animation
    gsap.utils.toArray('.service-card').forEach((card, index) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top bottom-=50',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 50,
            duration: 0.8,
            delay: index * 0.1,
            ease: 'power3.out'
        });
    });
    
    // Process steps animation
    gsap.utils.toArray('.process-step').forEach((step, index) => {
        gsap.from(step, {
            scrollTrigger: {
                trigger: step,
                start: 'top bottom-=50',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            scale: 0.8,
            duration: 0.6,
            delay: index * 0.2,
            ease: 'back.out(1.7)'
        });
    });
    
    // Floating animation for WhatsApp
    gsap.to('.animate-float', {
        y: -10,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: 'power1.inOut'
    });
});

// Scroll functions
function scrollToServices() {
    document.getElementById('services').scrollIntoView({ behavior: 'smooth' });
}

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<!-- Custom Styles -->
<style>
/* Animation delays */
.animation-delay-1000 {
    animation-delay: 1s;
}

/* Process step hover effects */
.process-step {
    transition: all 0.3s ease;
}

.process-step:hover {
    transform: translateY(-5px);
}

/* Service card styles */
.service-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 30px -12px rgba(0, 0, 0, 0.15);
}

/* Scroll indicator animation */
@keyframes scroll {
    0% { transform: translateY(0); opacity: 1; }
    100% { transform: translateY(15px); opacity: 0; }
}

.animate-scroll {
    animation: scroll 1.5s infinite;
}

/* Mobile optimizations */
@media (max-width: 640px) {
    .service-card {
        margin-bottom: 1rem;
    }
    
    .process-step {
        margin-bottom: 2rem;
    }
    
    .text-gray-600 {
        color: #4b5563;
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Canvas container */
#canvas-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

/* Dark mode adjustments */
.dark #canvas-container canvas {
    opacity: 0.7;
}
</style>
@endsection