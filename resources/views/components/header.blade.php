<header class="container mx-auto py-3 px-3">
    <div class="sm:flex sm:justify-between sm:items-center flex-row gap-3">
        <div class="flex items-center gap-10">
            <div>
                <a href="{{ url('/home') }}">
                    <p class="font-bold">Dopamine.</p>
                </a>
            </div>

            <ul class="flex gap-3">
                <li class="py-5 text-sm">
                    <a href="{{ route('shop') }}"> Shop </a>
                </li>
            </ul>
        </div>

        <form action="{{ route('shop') }}" method="GET" class="w-full relative">
            <input type="text"
                class="border border-[#D9D9D9] rounded-xl px-3 py-5 w-full text-sm"
                placeholder="Search for products" id="search" name="search" autocomplete="off"
                value="{{ request('search') }}" />

            <div id="searchSuggestions"
                class="overflow-hidden absolute top-full left-0 w-full bg-white border border-[#D9D9D9] rounded-xl mt-2 shadow-lg hidden z-50">
            </div>
        </form>
        <div class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto bg-[#F5F5F5] text-sm px-8 py-5 rounded-xl cursor-pointer inline-flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="size-4">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                    </svg>
                </a>
            @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to log out?');"
                        class="w-full sm:w-auto bg-[#F5F5F5] text-sm px-8 py-5 rounded-xl cursor-pointer inline-flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4">
                            <path fill-rule="evenodd"
                                d="M7.5 3A1.5 1.5 0 0 0 6 4.5v15A1.5 1.5 0 0 0 7.5 21h6a.75.75 0 0 0 0-1.5h-6v-15h6a.75.75 0 0 0 0-1.5h-6Zm7.72 4.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H9.75a.75.75 0 0 1 0-1.5h7.94l-2.47-2.47a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            @endguest
        </div>
        <a href="{{ route('cart') }}"
            class="w-full sm:w-auto bg-[#2B662D] text-sm px-8 py-5 rounded-xl inline-flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="white"
                class="size-4">
                <path
                    d="M1.75 1.002a.75.75 0 1 0 0 1.5h1.835l1.24 5.113A3.752 3.752 0 0 0 2 11.25c0 .414.336.75.75.75h10.5a.75.75 0 0 0 0-1.5H3.628A2.25 2.25 0 0 1 5.75 9h6.5a.75.75 0 0 0 .73-.578l.846-3.595a.75.75 0 0 0-.578-.906 44.118 44.118 0 0 0-7.996-.91l-.348-1.436a.75.75 0 0 0-.73-.573H1.75ZM5 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM13 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
            </svg>
        </a>
    </div>
    </div>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const suggestionsBox = document.getElementById('searchSuggestions');

        if (!searchInput || !suggestionsBox) return;

        let timeout = null;

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            clearTimeout(timeout);

            if (query.length < 1) {
                suggestionsBox.classList.add('hidden');
                suggestionsBox.innerHTML = '';
                return;
            }

            timeout = setTimeout(() => {
                fetch(
                        `/search-suggestions?search=${encodeURIComponent(query)}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (!data.length) {
                            suggestionsBox.innerHTML = `
                            <div class="px-4 py-3 text-sm text-gray-500">
                                No products found
                            </div>
                        `;
                            suggestionsBox.classList.remove('hidden');
                            return;
                        }

                        suggestionsBox.innerHTML = data.map(product => `
                        <a href="/product/${product.slug}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 border-b last:border-b-0 border-[#EFEFEF]">
                            <img
                                src="${product.image}"
                                alt="${product.alt}"
                                class="w-12 h-12 rounded-lg object-cover border border-gray-200 shrink-0"
                            >
                            <div class="min-w-0">
                                <div class="font-medium text-sm truncate">${product.name}</div>
                                <div class="text-xs text-gray-500">${
                                    product.category
                                    ? product.category.charAt(0).toUpperCase() + product.category.slice(1)
                                    : ''} Fruit</div>
                                <div class="text-xs font-semibold mt-1">${product.price} €</div>
                            </div>
                        </a>
                    `).join('') + `
                        <a href="/shop?search=${encodeURIComponent(query)}"
                           class="block px-4 py-3 text-sm font-semibold hover:bg-gray-100">
                            Show all results
                        </a>
                    `;

                        suggestionsBox.classList.remove('hidden');
                    })
                    .catch(() => {
                        suggestionsBox.classList.add('hidden');
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e
                    .target)) {
                suggestionsBox.classList.add('hidden');
            }
        });

        searchInput.addEventListener('focus', function() {
            if (suggestionsBox.innerHTML.trim() !== '') {
                suggestionsBox.classList.remove('hidden');
            }
        });
    });
</script>
