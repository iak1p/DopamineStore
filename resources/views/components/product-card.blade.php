@if ($product)
    <div
        class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition {{ $product->stock > 0 ? 'hover:bg-[#F1F1F1]' : '' }}"
        data-product
        data-category="{{ $product->category }}"
        data-price="{{ $product->price }}"
        data-stock="{{ $product->stock > 0 ? 'instock' : 'soldout' }}"
    >
        @if ($product->stock <= 0)
            <span
                class="absolute left-3 top-3 rounded-full bg-[#FFF0F0] px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-[#C62828]"
            >
                Sold out
            </span>
        @endif

        <a href="./product_info.html" class="block {{ $product->stock <= 0 ? 'opacity-70' : '' }}">
            <div class="flex h-40 justify-center">
                <img
                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                    alt="{{ $product->images->first()->alt_text ?? $product->name }}"
                    class="h-full w-auto object-contain"
                    loading="lazy"
                />
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm font-semibold text-[#111]">{{ $product->images->first()->alt_text ?? $product->name }}</p>
                <p class="mt-1 text-xs text-[#9A9A9A]">{{ $product->category }} fruit • 1 kg</p>
                <p class="mt-3 text-sm font-semibold text-[#111]">€{{ number_format($product->price, 2, ',', '') }}</p>
            </div>
        </a>
    </div>
@endif
