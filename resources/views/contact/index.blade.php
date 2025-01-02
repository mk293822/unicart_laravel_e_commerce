<x-app-layout>
    <section class="bg-gray-100 pt-[5rem] pb-8 px-6 sm:px-8 lg:px-12">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Contact Us</h2>
        <p class="mt-4 text-lg text-gray-500">Have any questions or want to get in touch? We would love to hear from you!</p>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="mt-8 max-w-xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form method="POST" action="/contact">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Your Name</label>
                <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your name">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Your Email</label>
                <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="message" class="block text-gray-700 font-medium">Your Message</label>
                <textarea name="message" id="message" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your message here..."></textarea>
                @error('message')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Send Message
            </button>
        </form>
    </div>
</section>

</x-app-layout>
