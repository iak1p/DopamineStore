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

    <main class="container mx-auto px-3 pb-12">
        <nav class="mt-6 text-sm text-[#8A8A8A]">
            <a
                href="{{ route('shop', ['category' => $product['category']]) }}"
                class="hover:underline"
                >{{ ucfirst(implode(' ', explode('-', $product['category']))) }}</a
            >
            <span class="mx-2">›</span>
            <span class="text-[#111]">{{ $product['name'] }}</span>
        </nav>

        <section class="mt-8 grid grid-cols-1 gap-10 lg:grid-cols-2">
            <div class="flex gap-6">
                <div class="hidden flex-col gap-3 sm:flex">
                    <button class="h-16 w-16 rounded-xl border border-[#EAEAEA] bg-[#F6F6F6] p-2">
                        <img
                            src="/phase1/templates/assets/img/peach.png"
                            class="h-full w-full object-contain"
                            alt="Peach thumbnail"
                        />
                    </button>
                    <button class="h-16 w-16 rounded-xl border border-[#EAEAEA] bg-[#F6F6F6] p-2">
                        <img
                            src="/phase1/templates/assets/img/peach.png"
                            class="h-full w-full object-contain"
                            alt="Peach thumbnail"
                        />
                    </button>
                </div>

                <div
                    class="flex min-h-105 flex-1 items-center justify-center rounded-2xl border border-[#EEEEEE] bg-white p-6"
                >
                    <img
                        src="/phase1/templates/assets/img/peach.png"
                        alt="Peach"
                        class="max-h-130 w-auto object-contain"
                    />
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-[#111] sm:text-4xl">
                    {{ $product['name'] }}
                    <span
                        class="ml-2 text-sm font-medium text-[#8A8A8A]"
                        >{{ $product['description'] }}</span
                    >
                </h1>

                <p class="mt-1 text-sm text-[#2B662D]">Premium seasonal selection</p>

                <div class="mt-6">
                    <p class="text-3xl font-semibold text-[#2B662D]">
                        €{{ $product['price'] }}
                        <span class="text-sm font-medium text-[#8A8A8A]">with DPH</span>
                    </p>
                    <p class="mt-1 text-sm text-[#9A9A9A]">Unit price: 3.90 € per 1 kg</p>
                </div>

                <p class="mt-6 max-w-xl text-sm leading-7 text-[#4A4A4A]">Sweet, juicy and carefully selected peaches with a delicate aroma and soft texture. Ideal for everyday snacking, desserts, smoothies or fruit salads.</p>

                <p class="mt-4 text-sm text-[#4A4A4A]">
                    <span class="font-semibold">Ingredients:</span> 100% fresh peaches
                </p>

                <div class="mt-8 text-sm text-[#4A4A4A]">
                    Available quantity
                    <span class="font-semibold text-[#111]">12 kg</span>
                </div>

                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div
                        class="flex w-full items-center justify-between rounded-full border border-[#E6E6E6] bg-white px-3 py-2 sm:w-35"
                    >
                        <button class="h-8 w-8 rounded-full hover:bg-[#F6F6F6]">−</button>
                        <span class="text-sm font-semibold">1</span>
                        <button class="h-8 w-8 rounded-full hover:bg-[#F6F6F6]">+</button>
                    </div>

                    <button
                        class="w-full rounded-full bg-[#2B662D] px-6 py-3 font-semibold text-white sm:w-auto"
                    >
                        Add to cart
                    </button>

                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit">Order now</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <x-footer />
</body>
</html>
