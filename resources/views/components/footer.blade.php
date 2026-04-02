<footer class="bg-[#111111] text-white mt-16">
    <div class="container mx-auto px-3 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <div>
            <a href="{{ url('/home') }}" class="inline-block">
                <p class="text-2xl font-bold">Dopamine.</p>
            </a>
            <p class="mt-4 text-sm text-[#BDBDBD] leading-6 max-w-xs">Fresh fruits, clean design, and a little daily
                dopamine. Bringing color and taste to your table.</p>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Navigation</h4>
            <ul class="space-y-3 text-sm text-[#D9D9D9]">
                <li>
                    <a href="{{ url('/home') }}" class="hover:text-white transition">Home</a>
                </li>
                <li>
                    <a href="{{ route('shop') }}" class="hover:text-white transition">Shop</a>
                </li>
                <li>
                    <a href="{{ route('cart') }}" class="hover:text-white transition">Cart</a>
                </li>
                <li>
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-white transition">Login</a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to log out?');"
                                class="bg-transparent p-0 border-0 hover:text-white transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @endguest
                </li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Contact</h4>
            <ul class="space-y-3 text-sm text-[#D9D9D9]">
                <li>
                    <a href="mailto:hello@dopamine.store" class="hover:text-white transition">
                        hello@dopamine.store
                    </a>
                </li>
                <li>
                    <a href="https://instagram.com/yurmall" target="_blank" class="hover:text-white transition">
                        Instagram
                    </a>
                </li>
                <li>Bratislava, Slovakia</li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Stay fresh</h4>
            <p class="text-sm text-[#BDBDBD] leading-6">Follow us for fresh arrivals, seasonal picks, and fruity vibes.
            </p>

            <a href="https://instagram.com/iak1p" target="_blank"
                class="inline-flex items-center gap-2 mt-5 bg-white text-black px-5 py-3 rounded-xl text-sm font-medium hover:opacity-90 transition">
                Follow on Instagram
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.25 6.75h-10.5A2.25 2.25 0 0 0 4.5 9v8.25A2.25 2.25 0 0 0 6.75 19.5h10.5A2.25 2.25 0 0 0 19.5 17.25V9a2.25 2.25 0 0 0-2.25-2.25ZM16.5 4.5h-9A3.75 3.75 0 0 0 3.75 8.25v7.5A3.75 3.75 0 0 0 7.5 19.5h9a3.75 3.75 0 0 0 3.75-3.75v-7.5A3.75 3.75 0 0 0 16.5 4.5ZM15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm1.875-4.125h.008v.008h-.008v-.008Z" />
                </svg>
            </a>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div
            class="container mx-auto px-3 py-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-[#AFAFAF]">
            <p>© 2026 Dopamine. All rights reserved.</p>
            <p>Designed with fruit and good taste.</p>
        </div>
    </div>
</footer>
