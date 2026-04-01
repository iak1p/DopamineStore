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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainProductImage');
        const thumbs = document.querySelectorAll('.product-thumb');

        thumbs.forEach(function(thumb) {
            thumb.addEventListener('click', function() {
                const newImage = this.dataset.image;
                mainImage.src = newImage;
            });
        });
    });
</script>

<body class="font-[Manrope]">
    <x-header />

    <main class="container mx-auto px-3 pb-12">
        <nav class="mt-6 text-sm text-[#8A8A8A]">
            <a href="{{ route('shop', ['category' => $product['category']]) }}"
                class="hover:underline">{{ ucfirst(implode(' ', explode('-', $product['category']))) }}
                Fruit</a>
            <span class="mx-2">›</span>
            <span class="text-[#111]">{{ $product['name'] }}</span>
        </nav>

        <section class="mt-8 grid grid-cols-1 gap-10 lg:grid-cols-2">
            <div class="flex gap-6">
                <div class="hidden flex-col gap-3 sm:flex">
                    @foreach ($product['images'] as $image)
                        <button type="button"
                            data-image="{{ asset('storage/' . $image['image_path']) }}"
                            class="product-thumb h-16 w-16 rounded-xl border border-[#EAEAEA] bg-[#F6F6F6] p-2 cursor-pointer">
                            <img src="{{ asset('storage/' . $image['image_path']) }}"
                                class="h-full w-full object-contain" alt="{{ $product['name'] }}" />
                        </button>
                    @endforeach
                </div>

                <div
                    class="flex min-h-105 flex-1 items-center justify-center rounded-2xl border border-[#EEEEEE] bg-white p-6 
                        {{ $product->stock <= 0 ? 'opacity-70' : '' }} relative">
                    @if ($product->stock <= 0)
                        <span
                            class="absolute left-3 top-3 rounded-full bg-[#FFF0F0] px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-[#C62828]">
                            Sold out
                        </span>
                    @endif
                    <img id="mainProductImage"
                        src="{{ asset('storage/' . $product['images'][0]['image_path']) }}"
                        alt="Peach" class="max-h-130 w-auto object-contain" />
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-semibold tracking-tight text-[#111] sm:text-4xl">
                    {{ $product['name'] }}
                    <span class="ml-2 text-sm font-medium text-[#8A8A8A]">Fresh fruit | 1
                        {{ $product['unit'] }}</span>
                </h1>

                <p class="mt-1 text-sm text-[#2B662D]">Premium seasonal selection</p>

                <div class="mt-6">
                    <p class="text-3xl font-semibold text-[#2B662D]">
                        {{ $product['price'] }} €
                        <span class="text-sm font-medium text-[#8A8A8A]">with DPH</span>
                    </p>
                    <p class="mt-1 text-sm text-[#9A9A9A]">
                        Unit price: {{ $product['price'] }} € per 1 {{ $product['unit'] }}
                    </p>
                </div>

                <p class="mt-6 max-w-xl text-sm leading-7 text-[#4A4A4A]">
                    {{ $product['description'] }}
                </p>

                <p class="mt-4 text-sm text-[#4A4A4A]">
                    <span class="font-semibold">Ingredients:</span> 100%
                    fresh {{ strtolower($product['name']) }}
                </p>

                <div class="mt-8 text-sm text-[#4A4A4A]">
                    Available quantity
                    <span class="font-semibold text-[#111]">{{ $product['stock'] }}
                        {{ $product['unit'] }}</span>
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
