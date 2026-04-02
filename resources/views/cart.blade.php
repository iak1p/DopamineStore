<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="font-[Manrope]">
    @php
        $totalExVat = 0;
        $totalVat = 0;
        $totalIncVat = 0;
    @endphp

    <x-header />
    <main class="container mx-auto px-3 pb-14">
        <div class="mt-4 border-y border-[#EFEFEF] py-4">
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center gap-2 font-semibold">
                    <span>1. Order Summary</span>
                    <span class="text-[#2B662D]">›</span>
                </div>
                <div class="hidden text-[#8A8A8A] sm:block">2. Contact Information</div>
                <div class="hidden text-[#8A8A8A] sm:block">3. Shipping and Payment</div>
            </div>
        </div>

        <h2 class="mt-10 text-2xl font-semibold text-[#2B662D]">Order Summary</h2>

        <div class="mt-6">
            <div
                class="hidden items-center gap-4 border-b border-[#EFEFEF] pb-3 text-sm font-semibold text-[#333] md:grid md:grid-cols-[1fr_90px_100px_120px_120px_40px]">
                <div>Product</div>
                <div class="text-center">DPH</div>
                <div class="text-center">Quantity</div>
                <div class="text-center">Price kg/pcs</div>
                <div class="text-center">Total</div>
                <div></div>
            </div>

            @forelse ($cart->items as $item)
                @php
                    $vatRate = 20;
                    $vatDivider = 1 + $vatRate / 100;

                    $unitPriceIncVat = $item->unit_price;
                    $unitPriceExVat = $unitPriceIncVat / $vatDivider;

                    $lineTotalIncVat = $unitPriceIncVat * $item->quantity;
                    $lineTotalExVat = $unitPriceExVat * $item->quantity;
                    $lineVat = $lineTotalIncVat - $lineTotalExVat;

                    $totalExVat += $lineTotalExVat;
                    $totalVat += $lineVat;
                    $totalIncVat += $lineTotalIncVat;

                    $categoryName =
                        collect($categories)->firstWhere('slug', $item->product->category)['name'] ??
                        $item->product->category;
                @endphp
                <div
                    class="grid grid-cols-1 items-center gap-4 border-b border-[#EFEFEF] py-5 md:grid-cols-[1fr_90px_100px_120px_120px_40px]">
                    <div class="flex items-center gap-4">
                        <img src="{{ Storage::url($item->product->images->first()?->image_path ?? 'products/placeholder.png') }}"
                            alt="{{ $item->product->images->first()?->alt_text ?? $item->product->name }}"
                            class="h-14 w-14 rounded-lg border border-[#EEE] bg-[#F6F6F6] p-2 object-contain" />

                        <div class="min-w-0">
                            <div class="font-semibold text-[#222]">{{ $item->product->name }}</div>

                            <div class="text-sm font-light text-[#2222227b]">
                                {{ $categoryName }}
                            </div>

                            <div class="mt-1 text-sm text-[#666] md:hidden">
                                DPH: {{ $vatRate }}%
                            </div>

                            <div class="text-sm text-[#666] md:hidden">
                                Price kg/pcs: €{{ number_format($item->unit_price, 2) }}
                            </div>

                            <div class="text-sm font-semibold text-[#333] md:hidden">
                                Qty: {{ $item->quantity }}
                            </div>

                            <div class="text-sm font-semibold text-[#333] md:hidden">
                                Total: €{{ number_format($lineTotalExVat, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="hidden text-center text-sm text-[#333] md:block">
                        {{ $vatRate }}%
                    </div>

                    <div class="hidden md:flex items-center justify-center gap-2">
                        <form action="{{ route('cart.decrease', $item) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                class="flex h-8 w-8 items-center justify-center rounded-full border text-sm font-semibold
                {{ $item->quantity > 1
                    ? 'border-[#D9D9D9] text-[#333] hover:bg-[#F5F5F5]'
                    : 'border-[#ECECEC] text-[#BDBDBD] cursor-not-allowed' }}"
                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                -
                            </button>
                        </form>

                        <span class="min-w-[24px] text-center text-sm font-semibold text-[#333]">
                            {{ $item->quantity }}
                        </span>

                        <form action="{{ route('cart.increase', $item) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                class="flex h-8 w-8 items-center justify-center rounded-full border text-sm font-semibold
    {{ $item->quantity < $item->product->stock
        ? 'border-[#D9D9D9] text-[#333] hover:bg-[#F5F5F5]'
        : 'border-[#ECECEC] text-[#BDBDBD] cursor-not-allowed' }}"
                                {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                +
                            </button>
                        </form>
                    </div>
                    <div class="hidden text-center text-sm text-[#333] md:block">
                        €{{ number_format($item->unit_price, 2) }}
                    </div>

                    <div class="hidden text-center text-sm font-semibold text-[#333] md:block">
                        €{{ number_format($lineTotalIncVat, 2) }}
                    </div>

                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="justify-self-end">
                        @csrf
                        @method ('DELETE')

                        <button type="submit" class="text-xl leading-none text-red-500 hover:opacity-70"
                            title="Remove">
                            ×
                        </button>
                    </form>
                </div>
            @empty
                <div class="rounded-2xl border border-[#EFEFEF] py-10 text-center text-[#666]">
                    Your cart is empty.
                </div>
            @endforelse

            <div class="w-full md:ml-auto md:w-[420px]">
                <div class="mt-10 text-lg font-medium text-[#333]">Summary</div>

                <div class="mt-4 flex items-center justify-between text-sm text-[#333]">
                    <span class="text-[#666]">Total (excluding DPH)</span>
                    <span>€{{ number_format($totalExVat, 2) }}</span>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm text-[#333]">
                    <span class="text-[#666]">DPH</span>
                    <span>€{{ number_format($totalVat, 2) }}</span>
                </div>

                <div class="mt-2 flex items-center justify-between text-sm font-semibold text-[#2B662D]">
                    <span>Including DPH</span>
                    <span>€{{ number_format($totalIncVat, 2) }}</span>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('checkout.contact') }}"
                        class="inline-flex items-center justify-center rounded-full bg-[#2B662D] px-6 py-3 font-semibold text-white hover:opacity-95">
                        Continue to personal information
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
