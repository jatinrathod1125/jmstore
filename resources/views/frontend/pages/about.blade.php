@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="relative bg-green-600 text-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">About Us</h1>
                <p class="text-xl max-w-2xl mx-auto">We are on a mission to deliver the freshest groceries directly to your
                    doorstep with love and care.</p>
            </div>
        </div>

        <!-- Our Story -->
        <div class="py-16">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                            alt="Fresh Groceries" class="rounded-lg shadow-xl w-full h-[400px] object-cover">
                    </div>
                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">Our Story</h2>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Founded in 2024, GroStore started with a simple idea: Grocery shopping should be easy,
                            convenient, and reliable. We noticed that people spend hours each week navigating crowded aisles
                            and waiting in long checkout lines. We wanted to change that.
                        </p>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            What began as a small local delivery service has now grown into a comprehensive online grocery
                            store. We partner with local farmers and top suppliers to ensure that every product you receive
                            is of the highest quality.
                        </p>
                        <p class="text-gray-600 leading-relaxed">
                            Our team is dedicated to customer satisfaction. From our carefully curated product selection to
                            our efficient delivery network, every step of our process is designed with you in mind.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection