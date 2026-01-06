@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Have a question? We'd love to hear from you. Send us a
                    message and we'll respond as soon as possible.</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Contact Info -->
                    <div class="space-y-6">
                        <!-- Office -->
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Our Office</h3>
                                    <p class="text-gray-600">123 Grocery St,<br>Tech City, TC 90210</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Email Us</h3>
                                    <p class="text-gray-600 mb-1">support@grostore.com</p>
                                    <p class="text-gray-600">partners@grostore.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="bg-white rounded-lg shadow-sm p-8">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <span
                                        class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 text-purple-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Call Us</h3>
                                    <p class="text-gray-600 mb-1">1800-123-4567 (Toll Free)</p>
                                    <p class="text-sm text-gray-500">Mon-Fri: 9am - 8pm</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white rounded-lg shadow-sm p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800">Send us a Message</h2>
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" name="name" id="name"
                                    class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                    placeholder="John Doe">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <input type="email" name="email" id="email"
                                    class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                    placeholder="john@example.com">
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                <input type="text" name="subject" id="subject"
                                    class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                    placeholder="How can we help?">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea name="message" id="message" rows="4"
                                    class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                    placeholder="Your message here..."></textarea>
                            </div>
                            <button type="button"
                                class="w-full bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition duration-200">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection