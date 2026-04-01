<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shipping and Payment</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
</head>
<body class="font-[Manrope]">
    @php
            $deliveryOptions = [
                [
                    'id' => 'standard',
                    'name' => 'Standard delivery within 60 minutes',
                    'price' => 1.50,
                    'icon' => '🚚',
                ],
                [
                    'id' => 'express',
                    'name' => 'Express delivery within 30 minutes',
                    'price' => 3.00,
                    'icon' => '⏱️',
                ],
                [
                    'id' => 'pickup',
                    'name' => 'In-store pickup',
                    'price' => 0.00,
                    'icon' => '📍',
                ],
            ];

            $paymentOptions = [
                [
                    'id' => 'cash',
                    'name' => 'Cash on delivery',
                    'icon' => '💵',
                ],
                [
                    'id' => 'card',
                    'name' => 'Card payment',
                    'icon' => '💳',
                ],
            ];

            $selectedDelivery = old('delivery_method', 'standard');
            $selectedPayment = old('payment_method', 'cash');

            $cartTotalExVat = 0;
            $cartVat = 0;
            $cartTotalIncVat = 0;

            foreach ($cart->items as $item) {
                $vatRate = $item->product->vat_rate ?? 20;
                $lineTotalExVat = $item->unit_price * $item->quantity;
                $lineVat = $lineTotalExVat * ($vatRate / 100);
                $lineTotalIncVat = $lineTotalExVat + $lineVat;

                $cartTotalExVat += $lineTotalExVat;
                $cartVat += $lineVat;
                $cartTotalIncVat += $lineTotalIncVat;
            }

            $selectedDeliveryPrice = collect($deliveryOptions)->firstWhere('id', $selectedDelivery)['price'] ?? 0;
            $grandTotal = $cartTotalIncVat + $selectedDeliveryPrice;
        @endphp

    <header class="container mx-auto px-3 py-3">
        <div class="flex-row gap-3 sm:flex sm:items-center sm:justify-between">
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

            <input
                type="text"
                class="w-full rounded-xl border border-[#D9D9D9] px-3 py-5 text-sm"
                placeholder="Search for products"
                id="search"
                name="search"
            />

            <div class="flex items-center gap-3">
                <button
                    class="w-full rounded-xl bg-[#F5F5F5] px-8 py-5 text-sm sm:w-auto"
                    type="button"
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
                </button>

                <a
                    href="{{ route('cart') }}"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-[#2B662D] px-8 py-5 text-sm sm:w-auto"
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
                </a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-3 pb-14">
        <div class="mt-4 border-y border-[#EFEFEF] py-4">
            <div class="flex items-center justify-between text-sm">
                <a href="{{ route('cart') }}" class="text-[#8A8A8A]"> 1. Order Summary </a>

                <a href="{{ route('checkout.contact') }}" class="text-[#8A8A8A]">
                    2. Contact Information
                </a>

                <div class="flex items-center gap-2 font-semibold">
                    <span>3. Shipping and Payment</span>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div
                class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
            >
                Please choose delivery and payment method.
            </div>
        @endif

        <form action="{{ route('checkout.submit') }}" method="POST" id="checkoutForm">
            @csrf

            <input
                type="hidden"
                name="delivery_method"
                id="delivery_method"
                value="{{ $selectedDelivery }}"
            />
            <input
                type="hidden"
                name="payment_method"
                id="payment_method"
                value="{{ $selectedPayment }}"
            />

            <h2 class="mt-10 text-2xl font-semibold text-[#2B662D]">Delivery</h2>

            <section class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-2">
                @foreach ($deliveryOptions as $option)
                    <button
                        type="button"
                        class="delivery-option rounded-xl bg-white p-6 text-left transition {{ $selectedDelivery === $option['id'] ? 'border-2 border-[#2B662D]' : 'border border-[#E5E5E5]' }}"
                        data-delivery-id="{{ $option['id'] }}"
                        data-delivery-price="{{ $option['price'] }}"
                    >
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">{{ $option['icon'] }}</span>
                            <div>
                                <div class="font-semibold text-[#333]">{{ $option['name'] }}</div>
                                <div class="text-sm text-[#666]">
                                    €{{ number_format($option['price'], 2) }}
                                </div>
                            </div>
                        </div>
                    </button>
                @endforeach

                <div class="mt-10 lg:col-span-2">
                    <p class="text-sm font-semibold text-[#555]">Payment</p>

                    <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @foreach ($paymentOptions as $option)
                            <button
                                type="button"
                                class="payment-option flex items-center justify-center gap-2 rounded-xl px-4 py-4 text-sm font-semibold transition {{ $selectedPayment === $option['id'] ? 'border-2 border-[#2B662D] text-[#2B662D]' : 'border border-[#D9D9D9] text-[#444]' }}"
                                data-payment-id="{{ $option['id'] }}"
                            >
                                <span>{{ $option['icon'] }}</span>
                                <span>{{ $option['name'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>

            <h2 class="mt-12 text-2xl font-semibold text-[#2B662D]">Order Summary</h2>

            <div class="mt-6">
                <div
                    class="hidden gap-4 border-b border-[#EFEFEF] pb-3 text-sm font-semibold text-[#333] md:grid md:grid-cols-[1fr_90px_120px_120px_140px]"
                >
                    <div>Product Name</div>
                    <div class="text-center">DPH %</div>
                    <div class="text-center">Price per kg</div>
                    <div class="text-center">Quantity</div>
                    <div class="text-center">Total price</div>
                </div>

                @foreach ($cart->items as $item)
                    @php
                            $vatRate = $item->product->vat_rate ?? 20;
                            $lineTotalExVat = $item->unit_price * $item->quantity;
                            $categoryName = collect($categories)->firstWhere('slug', $item->product->category)['name']
                                ?? $item->product->category;
                        @endphp
                    <div
                        class="grid grid-cols-1 items-center gap-4 border-b border-[#EFEFEF] py-5 md:grid-cols-[1fr_90px_120px_120px_140px]"
                    >
                        <div class="flex items-center gap-3 font-semibold text-[#222]">
                            <img
                                src="{{ Storage::url($item->product->images->first()?->image_path ?? 'products/placeholder.png') }}"
                                alt="{{ $item->product->images->first()?->alt_text ?? $item->product->name }}"
                                class="h-14 w-14 rounded-lg border border-[#EEE] bg-[#F6F6F6] p-2 object-contain"
                            />

                            <div>
                                <div>{{ $item->product->name }}</div>
                                <span class="text-xs font-medium text-[#8A8A8A]">
                                    {{ $categoryName }} | {{ $item->quantity }}
                                </span>
                            </div>
                        </div>

                        <div class="hidden text-center text-sm md:block">{{ $vatRate }}%</div>

                        <div class="hidden text-center text-sm md:block">
                            €{{ number_format($item->unit_price, 2) }}
                        </div>

                        <div class="hidden text-center text-sm md:block">{{ $item->quantity }}</div>

                        <div class="hidden text-center text-sm font-semibold md:block">
                            €{{ number_format($lineTotalExVat, 2) }}
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs text-[#666] md:hidden">
                            <div>
                                DPH:
                                <span class="font-semibold text-[#333]">{{ $vatRate }}%</span>
                            </div>
                            <div>
                                Price:
                                <span class="font-semibold text-[#333]"
                                    >€{{ number_format($item->unit_price, 2) }}</span
                                >
                            </div>
                            <div>
                                Qty:
                                <span class="font-semibold text-[#333]">{{ $item->quantity }}</span>
                            </div>
                            <div>
                                Total:
                                <span class="font-semibold text-[#333]"
                                    >€{{ number_format($lineTotalExVat, 2) }}</span
                                >
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-8 flex items-start justify-between">
                    <div></div>

                    <div class="text-right">
                        <div class="text-sm text-[#333]">
                            €{{ number_format($cartTotalExVat, 2) }}
                            <span class="text-[#8A8A8A]">bez DPH</span>
                        </div>

                        <div class="mt-1 text-sm text-[#333]">
                            Delivery:
                            <span class="font-semibold" id="deliveryPriceDisplay"
                                >€{{ number_format($selectedDeliveryPrice, 2) }}</span
                            >
                        </div>

                        <div class="mt-1 text-sm font-semibold text-[#2B662D]">
                            <span id="grandTotalDisplay">€{{ number_format($grandTotal, 2) }}</span>
                            <span class="font-medium text-[#8A8A8A]">with DPH</span>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-between">
                    <a
                        href="{{ route('checkout.contact') }}"
                        class="rounded-full border border-[#D9D9D9] px-6 py-3 font-semibold text-[#333]"
                    >
                        Back
                    </a>

                    <button
                        type="submit"
                        class="rounded-full bg-[#2B662D] px-6 py-3 font-semibold text-white md:ml-auto"
                    >
                        Submit order
                    </button>
                </div>
        </form>
    </main>
</body>
</html>
<script>
    const deliveryInput = document.getElementById('delivery_method');
    const paymentInput = document.getElementById('payment_method');

    const deliveryButtons = document.querySelectorAll('.delivery-option');
    const paymentButtons = document.querySelectorAll('.payment-option');

    const deliveryPriceDisplay = document.getElementById('deliveryPriceDisplay');
    const grandTotalDisplay = document.getElementById('grandTotalDisplay');

    const cartTotalIncVat = {{ json_encode($cartTotalIncVat) }};

    function setActiveDelivery(selectedId) {
        deliveryButtons.forEach((button) => {
            const isActive = button.dataset.deliveryId === selectedId;

            button.classList.remove('border-2', 'border-[#2B662D]', 'border', 'border-[#E5E5E5]');
            button.classList.add(isActive ? 'border-2' : 'border');
            button.classList.add(isActive ? 'border-[#2B662D]' : 'border-[#E5E5E5]');
        });
    }

    function setActivePayment(selectedId) {
        paymentButtons.forEach((button) => {
            const isActive = button.dataset.paymentId === selectedId;

            button.classList.remove(
                'border-2',
                'border-[#2B662D]',
                'text-[#2B662D]',
                'border',
                'border-[#D9D9D9]',
                'text-[#444]',
            );
            button.classList.add(isActive ? 'border-2' : 'border');
            button.classList.add(isActive ? 'border-[#2B662D]' : 'border-[#D9D9D9]');
            button.classList.add(isActive ? 'text-[#2B662D]' : 'text-[#444]');
        });
    }

    function updateTotals(deliveryPrice) {
        const total = Number(cartTotalIncVat) + Number(deliveryPrice);

        deliveryPriceDisplay.textContent = '€' + Number(deliveryPrice).toFixed(2);
        grandTotalDisplay.textContent = '€' + total.toFixed(2);
    }

    deliveryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const selectedId = button.dataset.deliveryId;
            const selectedPrice = button.dataset.deliveryPrice;

            deliveryInput.value = selectedId;
            setActiveDelivery(selectedId);
            updateTotals(selectedPrice);
        });
    });

    paymentButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const selectedId = button.dataset.paymentId;

            paymentInput.value = selectedId;
            setActivePayment(selectedId);
        });
    });
</script>
