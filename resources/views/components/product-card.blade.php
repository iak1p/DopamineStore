@if ($product)
    <div class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition {{ $product->stock > 0 ? 'hover:bg-[#F1F1F1]' : '' }}"
        data-product data-category="{{ $product->category }}" data-price="{{ $product->price }}"
        data-stock="{{ $product->stock > 0 ? 'instock' : 'soldout' }}">
        @if ($product->stock <= 0)
            <span
                class="absolute left-3 top-3 rounded-full bg-[#FFF0F0] px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-[#C62828]">
                Sold out
            </span>
        @endif

        @if ($admin)
            <div
                class="absolute top-3 right-3 flex gap-2 opacity-100 transition sm:opacity-0 sm:group-hover:opacity-100">
                <a href="{{ route('admin.edit', $product->slug) }}"
                    class="flex h-9 w-9 items-center justify-center rounded-full border border-[#E6E6E6] bg-white hover:bg-[#F5F5F5]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="size-4 text-[#333]">
                        <path
                            d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.5 9.5a.5.5 0 0 1-.168.11l-4 1.5a.5.5 0 0 1-.65-.65l1.5-4a.5.5 0 0 1 .11-.168l9.5-9.5ZM11.207 2.5 13.5 4.793 14.293 4 12 1.707 11.207 2.5Z" />
                    </svg>
                </a>

                <form action="{{ route('admin.delete', $product->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex h-9 w-9 items-center justify-center rounded-full border border-[#E6E6E6] bg-white hover:bg-[#FFECEC]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                            fill="currentColor" class="size-4 text-red-600">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v7a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0V6Zm2 .5a.5.5 0 0 1 .5-.5.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0V6Z" />
                            <path
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5.5l1-1h3l1 1H14a1 1 0 0 1 .5 1ZM4 4v9a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4H4Z" />
                        </svg>
                    </button>
                </form>

            </div>
        @endif

        <a href="{{ $product->url }}" class="block {{ $product->stock <= 0 ? 'opacity-70' : '' }}">
            <div class="flex h-40 justify-center">
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                    alt="{{ $product->images->first()->alt_text ?? $product->name }}"
                    class="h-full w-auto object-contain" loading="lazy" />
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm font-semibold text-[#111]">
                    {{ $product->name }}</p>
                <p class="mt-1 text-xs text-[#9A9A9A]">{{ ucfirst($product->category) }} fruit •
                    1
                    {{ $product->unit }}</p>
                <p class="mt-3 text-sm font-semibold text-[#111]">
                    {{ $product->price }} €</p>
            </div>
        </a>
    </div>
@endif
