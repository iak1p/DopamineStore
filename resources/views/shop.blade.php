<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body class="font-[Manrope]">
    <x-header />
    <main class="container mx-auto py-5 px-3">
        <section class="py-10">
            <div class="mx-auto max-w-7xl">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl lg:text-7xl">
                        Explore Our Shop
                    </h1>

                    <p
                        class="max-w-xl text-sm leading-6 text-[#3B3B3B] sm:text-base sm:leading-7 lg:mt-20">
                        From fresh seasonal fruits to exotic tropical selections, our shop offers
                        carefully chosen produce for every taste. We focus on freshness, quality,
                        and a smooth shopping experience — from selecting the best fruits to fast
                        and careful delivery. Discover your next favorite fruit with us.</p>
                </div>
            </div>
        </section>
        <section class="mt-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('shop', request()->except('category')) }}"
                        class="rounded-xl px-4 py-2 text-xs font-medium transition
                                {{ !$selectedCategory
                                    ? 'bg-[#F1F1F1] text-[#222] border border-[#E6E6E6]'
                                    : 'bg-white text-[#222] border border-[#E6E6E6] hover:bg-[#F7F7F7]' }}">
                        All Products
                    </a>

                    @foreach ($categories as $category)
                        <a href="{{ route('shop', array_merge(request()->query(), ['category' => $category['slug']])) }}"
                            class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs font-medium transition
                                    {{ $selectedCategory === $category['slug']
                                        ? 'bg-[#F1F1F1] text-[#222] border border-[#E6E6E6]'
                                        : 'bg-white text-[#222] border border-[#E6E6E6] hover:bg-[#F7F7F7]' }}">
                            {{ $category['name'] }}
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center gap-2">

                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.create') }}"
                                class="flex items-center hover:bg-[#F7F7F7] transition gap-2 rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6] cursor-pointer">
                                Add new product
                            </a>
                        @endif
                    @endauth

                    <button id="filtersBtn" type="button"
                        class="flex items-center hover:bg-[#F7F7F7] transition gap-2 rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6] cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="size-4">
                            <path
                                d="M6 7a2 2 0 1 1 4 0v1h12v2H10v1a2 2 0 1 1-4 0v-1H2V8h4V7Zm10 10a2 2 0 1 1 4 0v1h2v2h-2v1a2 2 0 1 1-4 0v-1H2v-2h14v-1Z" />
                        </svg>
                        Filters
                    </button>

                    {{-- <form method="GET" id="sort-form">
                        <select name="sort" onchange="this.form.submit()"
                            class="rounded-xl border border-[#E6E6E6] bg-white px-3 py-2 text-xs font-semibold text-[#222]">
                            <option>All</option>
                            <option value="price_asc">Price ↑</option>
                            <option value="price_desc">Price ↓</option>
                        </select>
                    </form> --}}
                </div>
            </div>

            <div id="filtersPanel" class="mt-3 rounded-2xl border border-[#E6E6E6] bg-white p-4">
                <form action="{{ route('shop') }}" method="GET">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <p class="text-xs font-semibold text-[#333] mb-2">Price (€)</p>
                            <div class="flex gap-2">
                                <input id="priceMin" name="price_min" type="number" min="0"
                                    step="0.01" value="{{ request('price_min') }}"
                                    placeholder="from"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs" />

                                <input id="priceMax" name="price_max" type="number" min="0"
                                    step="0.01" value="{{ request('price_max') }}"
                                    placeholder="to"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs" />
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-[#333] mb-2">Availability</p>
                            <select id="stockSelect" name="stock"
                                class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs">
                                <option value="">All</option>
                                <option value="instock"
                                    {{ request('stock') == 'instock' ? 'selected' : '' }}>
                                    In Stock
                                </option>
                                <option value="soldout"
                                    {{ request('stock') == 'soldout' ? 'selected' : '' }}>
                                    Sold Out
                                </option>
                            </select>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#333] mb-2">Sort</p>
                            <select name="sort"
                                class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs">
                                <option value="">Default</option>
                                <option value="price_asc"
                                    {{ $sort == 'price_asc' ? 'selected' : '' }}>Price: Low to High
                                </option>
                                <option value="price_desc"
                                    {{ $sort == 'price_desc' ? 'selected' : '' }}>Price: High to
                                    Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row gap-2 sm:justify-end">
                        <a href="{{ route('shop') }}"
                            class="rounded-xl border border-[#CFCFCF] bg-white px-4 py-2 text-xs font-semibold text-[#444] text-center">
                            Reset
                        </a>

                        <button id="applyFilters" type="submit"
                            class="rounded-xl bg-[#2B662D] px-4 py-2 text-xs font-semibold text-white cursor-pointer">
                            Apply
                        </button>
                    </div>
                </form>
            </div>


            @if (count($products) == 0)
                <p class="text-center mt-4">No items</p>
            @else
                <div id="productsGrid"
                    class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" :admin="auth()->check() && auth()->user()->isAdmin()" />
                    @endforeach
                </div>
            @endif

            <div class="mt-8 flex items-center justify-center gap-2" id="pagination">
                <a href="{{ $products->previousPageUrl() }}"
                    class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs cursor-pointer
                    {{ $products->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                    Prev
                </a>

                <span class="text-xs text-[#666]">
                    Page <b>{{ $products->currentPage() }}</b> /
                    <b>{{ $products->lastPage() }}</b>
                </span>

                <a href="{{ $products->nextPageUrl() }}"
                    class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs cursor-pointer
                    {{ !$products->hasMorePages() ? 'opacity-50 pointer-events-none' : '' }}">
                    Next
                </a>
            </div>
        </section>
    </main>
    <x-footer />
</body>
<script>
    const filtersPanel = document.getElementById('filtersPanel');
    const filtersBtn = document.getElementById('filtersBtn');
    filtersBtn.addEventListener('click', () => {
        filtersPanel.classList.toggle('hidden');
    });
</script>

</html>
