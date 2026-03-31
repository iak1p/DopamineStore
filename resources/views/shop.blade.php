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
        <header class="container mx-auto py-3 px-3">
            <div
                class="sm:flex sm:justify-between sm:items-center flex-row gap-3"
            >
                <div class="flex items-center gap-10">
                    <div class="">
                        <a href="main.html">
                            <p class="font-bold">Dopamine.</p>
                        </a>
                    </div>

                    <ul class="flex gap-3">
                        <li class="py-5 text-sm">
                            <a
                                href="shop.html"
                                aria-current="page"
                                class="aria-[current=page]:underline"
                            >
                                Shop
                            </a>
                        </li>
                    </ul>
                </div>

                <input
                    type="text"
                    class="border border-[#D9D9D9] rounded-xl px-3 py-5 w-full text-sm"
                    placeholder="Search for products"
                    id="search"
                    name="search"
                />

                <div class="flex items-center gap-3">
                    <a
                        href="./login.html"
                        class="w-full sm:w-auto bg-[#F5F5F5] text-sm px-8 py-5 rounded-xl cursor-pointer"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                            class="size-4"
                        >
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"
                            />
                        </svg>
                    </a>

                    <button
                        onclick="
                            window.location.href = 'assets/components/cart.html'
                        "
                        class="w-full sm:w-auto bg-[#2B662D] text-sm px-8 py-5 rounded-xl"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16"
                            fill="white"
                            class="size-4"
                        >
                            <path
                                d="M1.75 1.002a.75.75 0 1 0 0 1.5h1.835l1.24 5.113A3.752 3.752 0 0 0 2 11.25c0 .414.336.75.75.75h10.5a.75.75 0 0 0 0-1.5H3.628A2.25 2.25 0 0 1 5.75 9h6.5a.75.75 0 0 0 .73-.578l.846-3.595a.75.75 0 0 0-.578-.906 44.118 44.118 0 0 0-7.996-.91l-.348-1.436a.75.75 0 0 0-.73-.573H1.75ZM5 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM13 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </header>
        <main class="container mx-auto py-5 px-3">
            <section class="py-10">
                <div class="mx-auto max-w-7xl">
                    <div
                        class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between"
                    >
                        <h1
                            class="text-4xl font-semibold tracking-tight sm:text-5xl lg:text-7xl"
                        >
                            Explore Our Shop
                        </h1>

                        <p
                            class="max-w-xl text-sm leading-6 text-[#3B3B3B] sm:text-base sm:leading-7 lg:mt-20"
                        >
                            From fresh seasonal fruits to exotic tropical
                            selections, our shop offers carefully chosen produce
                            for every taste. We focus on freshness, quality, and
                            a smooth shopping experience — from selecting the
                            best fruits to fast and careful delivery. Discover
                            your next favorite fruit with us.
                        </p>
                    </div>
                </div>
            </section>
            <section class="mt-6">
                <div
                    class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                >
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
                                <path
                                    d="M12 7c-3-3-7-1-7 3 0 4 3 9 7 9s7-5 7-9c0-4-4-6-7-3z"
                                />
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
                                <rect
                                    x="3"
                                    y="7"
                                    width="18"
                                    height="13"
                                    rx="2"
                                />
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
                            <p class="text-xs font-semibold text-[#333] mb-2">
                                Cena (€)
                            </p>
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
                            <p class="text-xs font-semibold text-[#333] mb-2">
                                Dostupnosť
                            </p>
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

                    <div
                        class="mt-4 flex flex-col sm:flex-row gap-2 sm:justify-end"
                    >
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
                    <!-- Peach -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="stone"
                        data-price="3.90"
                        data-stock="instock"
                    >
                        <a
                            href="./product_info.html
                            "
                            class="block"
                        >
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/peach.png"
                                    alt="Peach"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Peach
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Stone fruit • 1 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €3,90
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Apricot -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="stone"
                        data-price="4.20"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/apricot.png"
                                    alt="Apricot"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Apricot
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Stone fruit • 1 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €4,20
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Orange -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="citrus"
                        data-price="2.80"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/orange.png"
                                    alt="Orange"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Orange
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Citrus fruit • 1 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €2,80
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Lemon -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group"
                        data-product
                        data-category="citrus"
                        data-price="2.40"
                        data-stock="soldout"
                    >
                        <span
                            class="absolute left-3 top-3 rounded-full bg-[#FFF0F0] px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-[#C62828]"
                        >
                            Sold out
                        </span>

                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center opacity-70">
                                <img
                                    src="/phase1/templates/assets/img/lemon.png"
                                    alt="Lemon"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Lemon
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Citrus fruit • 1 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €2,40
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Apple -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="pome"
                        data-price="2.50"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/apple.png"
                                    alt="Apple"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Apple
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Pome fruit • 1 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €2,50
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Pear -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="pome"
                        data-price="3.10"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/pear.png"
                                    alt="Pear"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Pear
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Pome fruit • 1 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €3,10
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Mango -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="exotic"
                        data-price="2.90"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/mango.png"
                                    alt="Mango"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Mango
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Exotic fruit • 1 pc
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €2,90
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Dragon Fruit -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="exotic"
                        data-price="5.50"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/dragon-fruit.png"
                                    alt="Dragon Fruit"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Dragon Fruit
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Exotic fruit • 1 pc
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €5,50
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Fruit Box Classic -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="boxes"
                        data-price="14.90"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/fruit-box.png"
                                    alt="Fruit Box Classic"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Fruit Box Classic
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Mixed fruits • 3 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €14,90
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Fruit Box Premium -->
                    <div
                        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                        data-product
                        data-category="boxes"
                        data-price="24.90"
                        data-stock="instock"
                    >
                        <a href="./product_info.html" class="block">
                            <div class="flex h-40 justify-center">
                                <img
                                    src="/phase1/templates/assets/img/fruit-box-premium.png"
                                    alt="Fruit Box Premium"
                                    class="h-full w-auto object-contain"
                                    loading="lazy"
                                />
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm font-semibold text-[#111]">
                                    Fruit Box Premium
                                </p>
                                <p class="mt-1 text-xs text-[#9A9A9A]">
                                    Mixed fruits • 5 kg
                                </p>
                                <p
                                    class="mt-3 text-sm font-semibold text-[#111]"
                                >
                                    €24,90
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div
                    class="mt-8 flex items-center justify-center gap-2"
                    id="pagination"
                >
                    <button
                        class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs"
                        id="prevPage"
                    >
                        Prev
                    </button>
                    <span class="text-xs text-[#666]"
                        >Page <b id="pageNum">1</b> /
                        <b id="pageTotal">1</b></span
                    >
                    <button
                        class="rounded-lg border border-[#E6E6E6] px-3 py-2 text-xs"
                        id="nextPage"
                    >
                        Next
                    </button>
                </div>
            </section>
        </main>
        <footer class="bg-[#111111] text-white mt-16">
            <div
                class="container mx-auto px-3 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10"
            >
                <!-- Brand -->
                <div>
                    <a href="main.html" class="inline-block">
                        <p class="text-2xl font-bold">Dopamine.</p>
                    </a>
                    <p class="mt-4 text-sm text-[#BDBDBD] leading-6 max-w-xs">
                        Fresh fruits, clean design, and a little daily dopamine.
                        Bringing color and taste to your table.
                    </p>
                </div>

                <!-- Navigation -->
                <div>
                    <h4
                        class="text-sm font-semibold uppercase tracking-wider mb-4"
                    >
                        Navigation
                    </h4>
                    <ul class="space-y-3 text-sm text-[#D9D9D9]">
                        <li>
                            <a
                                href="main.html"
                                class="hover:text-white transition"
                            >
                                Home
                            </a>
                        </li>
                        <li>
                            <a
                                href="shop.html"
                                class="hover:text-white transition"
                            >
                                Shop
                            </a>
                        </li>
                        <li>
                            <a
                                href="login.html"
                                class="hover:text-white transition"
                            >
                                Login
                            </a>
                        </li>
                        <li>
                            <a
                                href="./assets/components/cart.html"
                                class="hover:text-white transition"
                            >
                                Cart
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4
                        class="text-sm font-semibold uppercase tracking-wider mb-4"
                    >
                        Contact
                    </h4>
                    <ul class="space-y-3 text-sm text-[#D9D9D9]">
                        <li>
                            <a
                                href="mailto:hello@dopamine.store"
                                class="hover:text-white transition"
                            >
                                hello@dopamine.store
                            </a>
                        </li>
                        <li>
                            <a
                                href="https://instagram.com/yurmall"
                                target="_blank"
                                class="hover:text-white transition"
                            >
                                Instagram
                            </a>
                        </li>
                        <li>Bratislava, Slovakia</li>
                    </ul>
                </div>

                <!-- Newsletter / small text -->
                <div>
                    <h4
                        class="text-sm font-semibold uppercase tracking-wider mb-4"
                    >
                        Stay fresh
                    </h4>
                    <p class="text-sm text-[#BDBDBD] leading-6">
                        Follow us for fresh arrivals, seasonal picks, and fruity
                        vibes.
                    </p>

                    <a
                        href="https://instagram.com/iak1p"
                        target="_blank"
                        class="inline-flex items-center gap-2 mt-5 bg-white text-black px-5 py-3 rounded-xl text-sm font-medium hover:opacity-90 transition"
                    >
                        Follow on Instagram
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="w-4 h-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.25 6.75h-10.5A2.25 2.25 0 0 0 4.5 9v8.25A2.25 2.25 0 0 0 6.75 19.5h10.5A2.25 2.25 0 0 0 19.5 17.25V9a2.25 2.25 0 0 0-2.25-2.25ZM16.5 4.5h-9A3.75 3.75 0 0 0 3.75 8.25v7.5A3.75 3.75 0 0 0 7.5 19.5h9a3.75 3.75 0 0 0 3.75-3.75v-7.5A3.75 3.75 0 0 0 16.5 4.5ZM15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm1.875-4.125h.008v.008h-.008v-.008Z"
                            />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="border-t border-white/10">
                <div
                    class="container mx-auto px-3 py-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-[#AFAFAF]"
                >
                    <p>© 2026 Dopamine. All rights reserved.</p>
                    <p>Designed with fruit and good taste.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
