<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body class="font-[Manrope]">
    <x-header />
    <main class="container mx-auto px-3 pb-14">
        <h1 class="mt-8 text-3xl font-semibold tracking-tight">
            You are now editing {{ $product->name }}
        </h1>
        <p class="mt-2 text-sm text-[#666]">
            The product must contain at <b>title</b>,
            <b>description</b> and <b>at least 2 photos</b>.
        </p>

        <div class="mt-8 rounded-2xl border border-[#EFEFEF] bg-white p-6">
            <form action="{{ route('admin.edit.store', $product->slug) }}" method="POST"
                class="grid grid-cols-1 gap-10 lg:grid-cols-2" enctype="multipart/form-data"
                id="main-form">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block">
                        <span class="text-sm font-semibold text-[#555]">Title *</span>
                        <input id="name"
                            class="mt-2 w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                            placeholder="Peach.." name="name" value="{{ $product->name }}" />

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="mt-6 block">
                        <span class="text-sm font-semibold text-[#555]">Description *</span>
                        <textarea id="description"
                            class="mt-2 min-h-50 w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                            placeholder="Product description…" name="description">{{ $product->description }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>

                    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <label class="block">
                            <span class="text-sm font-semibold text-[#555]">Price (€) *</span>
                            <input type="number" step="0.01" min="0"
                                class="mt-2 w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                placeholder="3.90" name="price" value="{{ $product->price }}" />

                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-[#555]">Category *</span>
                            <select
                                class="mt-2 w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                name="category">
                                <option value="stone"
                                    {{ $product->category == 'stone' ? 'selected' : '' }}>
                                    Stone fruits
                                </option>

                                <option value="citrus"
                                    {{ $product->category == 'citrus' ? 'selected' : '' }}>
                                    Citrus fruits
                                </option>

                                <option value="exotic"
                                    {{ $product->category == 'exotic' ? 'selected' : '' }}>
                                    Exotic fruits
                                </option>

                                <option value="pome"
                                    {{ $product->category == 'pome' ? 'selected' : '' }}>
                                    Pome fruits
                                </option>

                                <option value="boxes"
                                    {{ $product->category == 'boxes' ? 'selected' : '' }}>
                                    Boxes
                                </option>
                            </select>

                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <label class="block">
                            <span class="text-sm font-semibold text-[#555]">Quantity *</span>
                            <input type="number" min="0"
                                class="mt-2 w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                placeholder="12" name="quantity" value="{{ $product->stock }}" />

                            @error('quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-[#555]">Unit *</span>
                            <select
                                class="mt-2 w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                name="unit">
                                <option value="kg"
                                    {{ $product->unit == 'kg' ? 'selected' : '' }}>kg
                                </option>
                                <option value="pcs"
                                    {{ $product->unit == 'pcs' ? 'selected' : '' }}>pcs
                                </option>
                            </select>

                            @error('unit')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block">
                        <span class="text-sm font-semibold text-[#555]">Photos *</span>
                        <input id="photos" type="file" accept="image/*" multiple
                            name="images[]"
                            class="mt-2 block w-full text-sm file:mr-4 file:rounded-full file:border-0 file:bg-[#2B662D] file:px-5 file:py-2 file:font-semibold file:text-white hover:file:opacity-95" />
                        <p id="photosHint" class="mt-2 text-xs text-[#8A8A8A]">
                            Select at least 2 images.
                        </p>

                        @error('images')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>
            </form>

            <div class="mt-6 flex gap-3">
                @foreach ($product['images'] as $image)
                    <div class="relative h-16 w-16">
                        <div
                            class="product-thumb h-full w-full rounded-xl border border-[#EAEAEA] bg-[#F6F6F6] p-2">
                            <img src="{{ asset('storage/' . $image['image_path']) }}"
                                class="h-full w-full object-contain"
                                alt="{{ $product['name'] }}" />
                        </div>
                        <form action="{{ route('admin.delete.img', $image['id']) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                {{ $product->images->count() == 1 ? 'disabled' : '' }}
                                class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full border border-[#E6E6E6] bg-white text-xs hover:bg-[#F5F5F5] shadow">
                                ✕
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button type="reset" form="main-form"
                    class="rounded-full border border-[#CFCFCF] px-6 py-3 font-semibold text-[#444]">
                    Cancel
                </button>

                <button type="submit" form="main-form"
                    class="rounded-full bg-[#2B662D] px-6 py-3 font-semibold text-white">
                    Save product
                </button>
            </div>
        </div>
    </main>
    <x-footer />
</body>

</html>
