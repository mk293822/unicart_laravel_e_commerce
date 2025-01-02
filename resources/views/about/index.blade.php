
<x-app-layout>
    <div class="bg-gray-100 pt-[5rem] pb-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">About Us</h2>
        <p class="mt-4 text-lg text-gray-500">We are committed to providing the best shopping experience for you. Here’s a bit about us.</p>
    </div>
    
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Section 1: Who We Are -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-2xl font-semibold text-gray-800">Who We Are</h3>
            <p class="mt-4 text-gray-600">We are a team of passionate individuals dedicated to revolutionizing e-commerce. Our goal is to provide a seamless online shopping experience that saves you time and effort.</p>
        </div>

        <!-- Section 2: Our Mission -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-2xl font-semibold text-gray-800">Our Mission</h3>
            <p class="mt-4 text-gray-600">Our mission is simple: to offer high-quality products at affordable prices, with excellent customer service to match. We strive to be your go-to place for everything you need.</p>
        </div>

        <!-- Section 3: Our Values -->
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-2xl font-semibold text-gray-800">Our Values</h3>
            <p class="mt-4 text-gray-600">We value integrity, transparency, and customer satisfaction. Every decision we make is based on these core values, ensuring that you always get the best from us.</p>
        </div>
    </div>

    <!-- Contact Us Section -->
    <div class="mt-8 bg-white p-8 rounded-lg shadow-lg">
        <h3 class="text-3xl font-extrabold text-gray-900 text-center">Get In Touch</h3>
        <p class="mt-4 text-lg text-gray-600 text-center">Have questions? Reach out to us anytime and we'll get back to you as soon as possible.</p>
        
        <div class="mt-8 flex justify-center">
            <a href="{{route("contact.index")}}" class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Contact Us
            </a>
        </div>
    </div>
</div>
</x-app-layout>

