@extends('layouts.app')

@section('title', $service->title . ' - HiveNarratives')
@section('meta-description', Str::limit($service->description, 160))
@section('meta-keywords', $service->tags)

@section('content')
<!-- Hero Section with Gradient Background -->
<div class="relative bg-gradient-to-br from-purple-900 via-purple-800 to-indigo-900 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-16 mt-16">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-white/80">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors flex items-center">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-xs mx-2 text-white/50"></i></li>
                <li>
                    <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Services</a>
                </li>
                <li><i class="fas fa-chevron-right text-xs mx-2 text-white/50"></i></li>
                <li class="text-white font-medium truncate max-w-xs">{{ $service->title }}</li>
            </ol>
        </nav>
        
        <div class="max-w-4xl">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm mb-4">
                <i class="fas fa-tag mr-2"></i>{{ $service->category }}
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">{{ $service->title }}</h1>
            <p class="text-xl text-white/80 max-w-3xl">{{ Str::limit($service->description, 120) }}</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Service Image Gallery -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="relative group">
                    <img src="{{ $service->image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1352&q=80' }}" 
                         alt="{{ $service->title }}" 
                         class="w-full h-[500px] object-cover transition-transform duration-500 group-hover:scale-105">
                    @if($service->featured)
                    <div class="absolute top-4 left-4 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                        <i class="fas fa-crown mr-1"></i> Featured Service
                    </div>
                    @endif
                </div>
            </div>

            <!-- Service Description -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-file-alt text-2xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Service Description</h2>
                </div>
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>

            <!-- Features with Modern Cards -->
            @if(!empty($service->features))
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-check-circle text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">What's Included</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($service->features as $feature)
                    <div class="flex items-start p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl hover:shadow-md transition-shadow">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- FAQs with Accordion -->
            @if(!empty($service->faqs))
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-question-circle text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Frequently Asked Questions</h2>
                </div>
                <div class="space-y-4" x-data="{ activeFaq: null }">
                    @foreach($service->faqs as $index => $faq)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                        <button 
                            @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-4 text-left bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex justify-between items-center"
                        >
                            <span class="font-semibold text-gray-800 dark:text-white">{{ $faq['question'] }}</span>
                            <i class="fas fa-chevron-down text-gray-500 transition-transform" 
                               :class="{ 'rotate-180': activeFaq === {{ $index }} }"></i>
                        </button>
                        <div x-show="activeFaq === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="px-6 py-4 text-gray-600 dark:text-gray-300">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Order Box - Sticky -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl sticky top-24 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-shopping-cart mr-2"></i> Order This Service
                    </h2>
                </div>
                
                <div class="p-6">
                    <!-- Price Display -->
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-gray-800 dark:text-white">${{ number_format($service->price, 2) }}</span>
                        <span class="text-gray-500 dark:text-gray-400">/project</span>
                    </div>

                    <!-- Service Stats -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <span class="text-gray-600 dark:text-gray-300 flex items-center">
                                <i class="fas fa-clock text-purple-500 mr-2"></i>Delivery Time
                            </span>
                            <span class="font-semibold text-gray-800 dark:text-white">{{ $service->delivery_time }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <span class="text-gray-600 dark:text-gray-300 flex items-center">
                                <i class="fas fa-sync-alt text-purple-500 mr-2"></i>Revisions
                            </span>
                            <span class="font-semibold text-gray-800 dark:text-white">{{ $service->revisions }}</span>
                        </div>
                    </div>

                    <!-- WhatsApp Button with Hover Effect -->
                    <a href="https://wa.me/923211417347?text=Hi! I'm interested in your service: {{ urlencode($service->title) }} (Price: ${{ $service->price }})" 
                       target="_blank" 
                       class="group block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-4 px-6 rounded-xl transition-all transform hover:scale-105 hover:shadow-xl mb-4">
                        <div class="flex items-center justify-center">
                            <i class="fab fa-whatsapp text-2xl mr-3 group-hover:rotate-12 transition-transform"></i>
                            <span class="text-lg">Continue on WhatsApp</span>
                        </div>
                        <p class="text-xs text-center mt-2 text-green-100">Quick response within 30 minutes</p>
                    </a>

                    <!-- Back Button -->
                    <a href="{{ route('services.index') }}" class="block text-center text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-sm py-2">
                        <i class="fas fa-arrow-left mr-1"></i> Browse all services
                    </a>
                </div>
            </div>

            <!-- Service Details Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                    Service Details
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center p-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-folder text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Category</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $service->category }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Delivery Time</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $service->delivery_time }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-redo-alt text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Revisions</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $service->revisions }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Services with Horizontal Scroll on Mobile -->
            @if($relatedServices->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-layer-group text-purple-500 mr-2"></i>
                    Related Services
                </h3>
                <div class="space-y-4">
                    @foreach($relatedServices as $relatedService)
                    <a href="{{ route('services.show', $relatedService) }}" class="block group">
                        <div class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-all">
                            <div class="relative w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $relatedService->image ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1352&q=80' }}" 
                                     alt="{{ $relatedService->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="text-gray-800 dark:text-white font-medium group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors line-clamp-2">
                                    {{ $relatedService->title }}
                                </h4>
                                <p class="text-purple-600 font-bold mt-1">${{ number_format($relatedService->price, 2) }}</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-600 transition-colors"></i>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Trust Badges -->
            <div class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-purple-500 mr-2"></i>
                    Why Choose Us
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700 dark:text-gray-300">100% Satisfaction Guaranteed</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock text-green-500 mr-3"></i>
                        <span class="text-gray-700 dark:text-gray-300">On-time Delivery</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-headset text-green-500 mr-3"></i>
                        <span class="text-gray-700 dark:text-gray-300">24/7 Customer Support</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-lock text-green-500 mr-3"></i>
                        <span class="text-gray-700 dark:text-gray-300">Secure Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WhatsApp Floating Button with Pulse Animation -->
<a href="https://wa.me/923211417347" 
   target="_blank" 
   class="fixed bottom-6 right-6 bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-full shadow-2xl hover:shadow-green-500/50 hover:scale-110 transition-all z-50 flex items-center justify-center w-16 h-16 group animate-pulse hover:animate-none"
   aria-label="Chat on WhatsApp">
    <i class="fab fa-whatsapp text-3xl group-hover:rotate-12 transition-transform"></i>
    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">1</span>
</a>

<!-- Add Alpine.js for FAQ accordion -->
<script src="//unpkg.com/alpinejs" defer></script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection