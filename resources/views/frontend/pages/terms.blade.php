@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-4xl font-bold text-gray-900 mb-8 border-b pb-4">Terms of Service</h1>

            <div class="prose prose-green max-w-none text-gray-600">
                <p class="mb-6">Last updated: {{ date('F d, Y') }}</p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">1. Acceptance of Terms</h2>
                <p class="mb-4">
                    By accessing and using this website, you accept and agree to be bound by the terms and provision of this
                    agreement. In addition, when using this websites particular services, you shall be subject to any posted
                    guidelines or rules applicable to such services.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">2. Use of Service</h2>
                <p class="mb-4">
                    You agree to use this site only for lawful purposes. You agree not to take any action that might
                    compromise the security of the site, render the site inaccessible to others or otherwise cause damage to
                    the site or the Content.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">3. Product Descriptions</h2>
                <p class="mb-4">
                    We attempt to be as accurate as possible. However, we do not warrant that product descriptions or other
                    content of this site is accurate, complete, reliable, current, or error-free. If a product offered by us
                    itself is not as described, your sole remedy is to return it in unused condition.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">4. Privacy Policy</h2>
                <p class="mb-4">
                    Your use of the site is also governed by our Privacy Policy. Please review our Privacy Policy, which
                    also governs the Site and informs users of our data collection practices.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">5. Modifications</h2>
                <p class="mb-4">
                    We reserve the right to change these terms from time to time as it sees fit and your continued use of
                    the site will signify your acceptance of any adjustment to these terms.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">6. Contact Information</h2>
                <p class="mb-4">
                    If you have any questions about these Terms, please contact us at support@grostore.com.
                </p>
            </div>
        </div>
    </div>
@endsection