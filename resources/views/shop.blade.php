<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
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
                            class="max-w-xl text-sm leading-6 text-[#3B3B3B] sm:text-base sm:leading-7 lg:mt-20"
                        >From fresh seasonal fruits to exotic tropical selections, our shop offers carefully chosen produce for every taste. We focus on freshness, quality, and a smooth shopping experience — from selecting the best fruits to fast and careful delivery. Discover your next favorite fruit with us.</p>
                    </div>
                </div>
            </section>
            <section class="mt-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex flex-wrap items-center gap-2">
                        <a
                            href="{{ route('shop') }}"
                            class="rounded-xl px-4 py-2 text-xs font-medium transition
                                {{ !$selectedCategory
                                    ? 'bg-[#F1F1F1] text-[#222] border border-[#E6E6E6]'
                                    : 'bg-white text-[#222] border border-[#E6E6E6] hover:bg-[#F7F7F7]' }}"
                        >
                            All Products
                        </a>

                        @foreach ($categories as $category)
                            <a
                                href="{{ route('shop', ['category' => lcfirst($category['slug'])]) }}"
                                class="flex items-center gap-2 rounded-xl px-4 py-2 text-xs font-medium transition
                                    {{ $selectedCategory === $category['slug']
                                        ? 'bg-[#F1F1F1] text-[#222] border border-[#E6E6E6]'
                                        : 'bg-white text-[#222] border border-[#E6E6E6] hover:bg-[#F7F7F7]' }}"
                            >
                                {{ $category['name'] }}
                            </a>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            id="filtersBtn"
                            type="button"
                            class="flex items-center gap-2 rounded-xl border border-[#E6E6E6] bg-white px-4 py-2 text-xs font-semibold text-[#222]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="size-4"
                            >
                                <path
                                    d="M6 7a2 2 0 1 1 4 0v1h12v2H10v1a2 2 0 1 1-4 0v-1H2V8h4V7Zm10 10a2 2 0 1 1 4 0v1h2v2h-2v1a2 2 0 1 1-4 0v-1H2v-2h14v-1Z"
                                />
                            </svg>
                            Filters
                        </button>

                        <form method="GET" id="sort-form">
                            <select
                                name="sort"
                                onchange="this.form.submit()"
                                class="rounded-xl border border-[#E6E6E6] bg-white px-3 py-2 text-xs font-semibold text-[#222]"
                            >
                                <option>All</option>
                                <option value="price_asc">Price ↑</option>
                                <option value="price_desc">Price ↓</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div
                    id="filtersPanel"
                    class="mt-3 hidden rounded-2xl border border-[#E6E6E6] bg-white p-4"
                >
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <p class="text-xs font-semibold text-[#333] mb-2">Cena (€)</p>
                            <div class="flex gap-2">
                                <input
                                    id="priceMin"
                                    type="number"
                                    min="0"
                                    placeholder="od"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs"
                                />
                                <input
                                    id="priceMax"
                                    type="number"
                                    min="0"
                                    placeholder="do"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs"
                                />
                            </div>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-[#333] mb-2">Dostupnosť</p>
                            <select
                                id="stockSelect"
                                class="w-full rounded-md border border-[#D9D9D9] px-3 py-2 text-xs"
                            >
                                <option value="">Všetko</option>
                                <option value="instock">Na sklade</option>
                                <option value="soldout">Vypredané</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row gap-2 sm:justify-end">
                        <button
                            id="resetFilters"
                            type="button"
                            class="rounded-xl border border-[#CFCFCF] bg-white px-4 py-2 text-xs font-semibold text-[#444]"
                        >
                            Reset
                        </button>
                        <button
                            id="applyFilters"
                            type="button"
                            class="rounded-xl bg-[#2B662D] px-4 py-2 text-xs font-semibold text-white"
                        >
                            Apply
                        </button>
                    </div>
                </div>

                @if (count($products) == 0)
                    <p class="text-center">No items</p>
                @else
                    <div
                        id="productsGrid"
                        class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
                    >
                        @foreach ($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                @endif

                <div class="mt-8 flex items-center justify-center gap-2" id="pagination">
                    <button
                        class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs cursor-pointer"
                        id="prevPage"
                    >
                        Prev
                    </button>
                    <span class="text-xs text-[#666]"
                        >Page <b id="pageNum">1</b> / <b id="pageTotal">1</b></span
                    >
                    <button
                        class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs cursor-pointers"
                        id="nextPage"
                    >
                        Next
                    </button>
                </div>
            </section>
        </main>
        <x-footer />
    </body>
    <script>
        document.getElementById('sort-form').addEventListener('submit', function (e) {
            e.preventDefault();
        });
    </script>
</html>
