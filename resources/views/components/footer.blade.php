<!-- resources/views/components/footer.blade.php -->

<footer class="bg-cover bg-center text-white py-12 mt-auto" style="background-image: url('{{ asset('images/brighterus2.jpg') }}');">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-x-16">
            <!-- About Us -->
            <div>
                <h3 class="text-lg font-bold mb-4">About Us</h3>
                <p class="text-white-400 leading-relaxed">BrighterUs is your one-stop platform for all things tertiary education in Malaysia. We simplify your search for universities, courses, scholarships, and career pathways. Our user-friendly interface and features like Career Match help you find the perfect fit for your future. You can explore university programs, scholarships, financial aid options, and much more, all in one place.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-yellow-400 hover:text-orange-500 transition duration-300">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('courses.index') }}" class="text-yellow-400 hover:text-orange-500 transition duration-300">
                            Courses & Universities
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events') }}" class="text-yellow-400 hover:text-orange-500 transition duration-300">
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('financial.need-based') }}" class="text-yellow-400 hover:text-orange-500 transition duration-300">
                            Financial Aid
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('career') }}" class="text-yellow-400 hover:text-orange-500 transition duration-300">
                            Career Match
                        </a>
                    </li>
                </ul>
            </div>


            <!-- Follow Us -->
            <div>
    <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
    <div class="flex space-x-4">
        <!-- Facebook -->
        <a href="#" class="text-[#1877F2] hover:text-[#166FE5] transition duration-300 transform hover:scale-110">
            <i class="fab fa-facebook fa-lg"></i>
        </a>

        <!-- Twitter -->
        <a href="#" class="text-[#1DA1F2] hover:text-[#1A8CD8] transition duration-300 transform hover:scale-110">
            <i class="fab fa-twitter fa-lg"></i>
        </a>

        <!-- Instagram -->
        <a href="#" class="text-[#E4405F] hover:text-[#D32A4A] transition duration-300 transform hover:scale-110">
            <i class="fab fa-instagram fa-lg"></i>
        </a>

        <!-- LinkedIn -->
        <a href="#" class="text-[#0A66C2] hover:text-[#0959A8] transition duration-300 transform hover:scale-110">
            <i class="fab fa-linkedin fa-lg"></i>
        </a>
    </div>
</div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Subscribe to Our Newsletter</h3>
                <form class="flex bg-gray-100 p-1 rounded-lg">
                    <input type="email" placeholder="Your email" class="w-full px-4 py-2 text-gray-900 bg-gray-100 rounded-l-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-r-md hover:bg-orange-600 transition duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="border-t border-white-800 mt-8 pt-4 text-center text-white-400">
        <p>&copy; 2025 BrighterUs. All rights reserved.</p>
    </div>
</footer>

<style>
    footer {
    position: relative;
}

footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.47); /* Dark overlay */
    z-index: 1;
}

footer > * {
    position: relative;
    z-index: 2; /* Ensures content is above the overlay */
}
</style>