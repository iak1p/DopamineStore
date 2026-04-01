<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Success</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
</head>
<body class="font-[Manrope] bg-white">
    <header class="container mx-auto px-3 py-3">
        <div class="flex flex-row gap-3 sm:items-center sm:justify-between">
            <div class="flex items-center gap-10">
                <div>
                    <p class="font-bold">Dopamine.</p>
                </div>

                <ul class="flex gap-3">
                    <li class="py-5 text-sm">
                        <a
                            href="{{ route('shop') }}"
                            aria-current="page"
                            class="aria-[current=page]:underline"
                        >
                            Shop
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-3 py-16">
        <div
            class="mx-auto max-w-2xl rounded-3xl border border-[#EAEAEA] px-8 py-14 text-center shadow-sm"
        >
            <div
                class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-[#EAF6EA] text-4xl"
            >
                ✓
            </div>

            <h1 class="mt-6 text-3xl font-semibold text-[#2B662D]">Order successfully received</h1>

            <p class="mx-auto mt-4 max-w-xl text-sm leading-6 text-[#666]">Thank you for your order. We have successfully received it and will start processing it shortly.</p>

            <p class="mt-2 text-sm leading-6 text-[#666]">You can now return to the shop and continue browsing products.</p>

            <div class="mt-10 flex justify-center">
                <a
                    href="{{ route('shop') }}"
                    class="inline-flex items-center justify-center rounded-full bg-[#2B662D] px-6 py-3 font-semibold text-white hover:opacity-95"
                >
                    Back to shop
                </a>
            </div>
        </div>
    </main>
</body>
</html>
