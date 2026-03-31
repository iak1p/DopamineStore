<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dopamine</title>
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
    <main>
        <img
            src="{{ asset('phase1\templates\assets\img\baner.png') }}"
            alt="Banner"
            class="w-full h-full object-cover"
        />

        <section class="container mx-auto py-5 px-3">
            <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold my-8">
                Popular Products
            </h3>

            <div
                id="productsGrid"
                class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
            >
                <div
                    class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                    data-product
                    data-category="stone"
                    data-price="3.90"
                    data-stock="instock"
                >
                    <a href="{{ url('/product-info') }}" class="block">
                        <div class="flex h-40 justify-center">
                            <img
                                src="{{ asset('assets/img/peach.png') }}"
                                alt="Peach"
                                class="h-full w-auto object-contain"
                                loading="lazy"
                            />
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-sm font-semibold text-[#111]">Peach</p>
                            <p class="mt-1 text-xs text-[#9A9A9A]">Stone fruit • 1 kg</p>
                            <p class="mt-3 text-sm font-semibold text-[#111]">€3,90</p>
                        </div>
                    </a>
                </div>

                <div
                    class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                    data-product
                    data-category="stone"
                    data-price="4.20"
                    data-stock="instock"
                >
                    <a href="{{ url('/product-info') }}" class="block">
                        <div class="flex h-40 justify-center">
                            <img
                                src="{{ asset('assets/img/apricot.png') }}"
                                alt="Apricot"
                                class="h-full w-auto object-contain"
                                loading="lazy"
                            />
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-sm font-semibold text-[#111]">Apricot</p>
                            <p class="mt-1 text-xs text-[#9A9A9A]">Stone fruit • 1 kg</p>
                            <p class="mt-3 text-sm font-semibold text-[#111]">€4,20</p>
                        </div>
                    </a>
                </div>

                <div
                    class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]"
                    data-product
                    data-category="citrus"
                    data-price="2.80"
                    data-stock="instock"
                >
                    <a href="{{ url('/product-info') }}" class="block">
                        <div class="flex h-40 justify-center">
                            <img
                                src="{{ asset('assets/img/orange.png') }}"
                                alt="Orange"
                                class="h-full w-auto object-contain"
                                loading="lazy"
                            />
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-sm font-semibold text-[#111]">Orange</p>
                            <p class="mt-1 text-xs text-[#9A9A9A]">Citrus fruit • 1 kg</p>
                            <p class="mt-3 text-sm font-semibold text-[#111]">€2,80</p>
                        </div>
                    </a>
                </div>

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

                    <a href="{{ url('/product-info') }}" class="block">
                        <div class="flex h-40 justify-center opacity-70">
                            <img
                                src="{{ asset('assets/img/lemon.png') }}"
                                alt="Lemon"
                                class="h-full w-auto object-contain"
                                loading="lazy"
                            />
                        </div>

                        <div class="mt-4 text-center">
                            <p class="text-sm font-semibold text-[#111]">Lemon</p>
                            <p class="mt-1 text-xs text-[#9A9A9A]">Citrus fruit • 1 kg</p>
                            <p class="mt-3 text-sm font-semibold text-[#111]">€2,40</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>
    <x-footer />
</body>
</html>
