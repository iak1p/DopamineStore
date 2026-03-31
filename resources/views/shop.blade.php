<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
                    <button
                        class="rounded-xl bg-[#F1F1F1] px-4 py-2 text-xs font-medium text-[#222]"
                    >
                        All Products
                    </button>

                    <button
                        class="flex items-center gap-2 hover:bg-[#F7F7F7] transition rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <circle cx="12" cy="13" r="6" />
                            <path d="M12 7c1.5-2 3-3 5-3" />
                        </svg>
                        Stone fruits
                    </button>

                    <button
                        class="flex items-center gap-2 hover:bg-[#F7F7F7] transition rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <ellipse cx="12" cy="13" rx="6" ry="8" />
                            <path d="M12 5c1-2 3-3 5-3" />
                        </svg>
                        Exotic fruits
                    </button>

                    <button
                        class="flex items-center gap-2 hover:bg-[#F7F7F7] transition rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <circle cx="12" cy="12" r="7" />
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Citrus fruits
                    </button>

                    <button
                        class="flex items-center gap-2 hover:bg-[#F7F7F7] transition rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <path d="M12 7c-3-3-7-1-7 3 0 4 3 9 7 9s7-5 7-9c0-4-4-6-7-3z" />
                            <path d="M12 5c1-2 3-3 5-3" />
                        </svg>
                        Pome fruits
                    </button>

                    <button
                        class="flex items-center hover:bg-[#F7F7F7] transition gap-2 rounded-xl bg-white px-4 py-2 text-xs font-medium text-[#222] border border-[#E6E6E6]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <rect x="3" y="7" width="18" height="13" rx="2" />
                            <path d="M3 7l9 5 9-5" />
                        </svg>
                        Boxes
                    </button>
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

                    <select
                        id="sortSelect"
                        class="rounded-xl border border-[#E6E6E6] bg-white px-3 py-2 text-xs font-semibold text-[#222]"
                    >
                        <option value="price_asc">Price ↑</option>
                        <option value="price_desc">Price ↓</option>
                    </select>
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

            <div
                id="productsGrid"
                class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
            >
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-8 flex items-center justify-center gap-2" id="pagination">
                <button class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs" id="prevPage">
                    Prev
                </button>
                <span class="text-xs text-[#666]"
                    >Page <b id="pageNum">1</b> / <b id="pageTotal">1</b></span
                >
                <button class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs" id="nextPage">
                    Next
                </button>
            </div>
        </section>
    </main>
    <x-footer />
</body>
</html>
