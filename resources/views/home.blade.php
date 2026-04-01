<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dopamine</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body class="font-[Manrope]">
    <x-header />
    <main>
        <img src="{{ asset('phase1\templates\assets\img\baner.png') }}" alt="Banner"
            class="w-full h-full object-cover" />

        <section class="container mx-auto py-5 px-3">
            <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold my-8">
                Popular Products
            </h3>

            <div id="productsGrid"
                class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    </main>
    <x-footer />
</body>

</html>
