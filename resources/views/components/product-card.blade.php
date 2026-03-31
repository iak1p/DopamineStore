<div class="relative rounded-2xl bg-[#F6F6F6] p-6 group transition hover:bg-[#F1F1F1]">
    <a href="{{ $link }}" class="block">
        <div class="flex h-40 justify-center">
            <img src="/phase1/templates/assets/img/orange.png" alt="{{ $name }}"
                class="h-full w-auto object-contain" loading="lazy" />
        </div>

        <div class="mt-4 text-center">
            <p class="text-sm font-semibold text-[#111]">
                {{ $name }}</p>
            <p class="mt-1 text-xs text-[#9A9A9A]">
                {{ $description }}</p>
            <p class="mt-3 text-sm font-semibold text-[#111]">
                €{{ $price }}</p>
        </div>
    </a>
</div>
