<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Information</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body class="font-[Manrope]">
    <x-header />
    <main class="container mx-auto px-3 pb-14">
        <div class="mt-4 border-y border-[#EFEFEF] py-4">
            <div class="flex items-center justify-between text-sm">
                <a href="{{ route('cart') }}" class="text-[#8A8A8A]"> 1. Order Summary </a>

                <div class="flex items-center gap-2 font-semibold">
                    <span>2. Contact Information</span>
                    <span class="text-[#2B662D]">›</span>
                </div>

                <div class="hidden text-[#8A8A8A] sm:block">3. Shipping and Payment</div>
            </div>
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                Please fill in the required fields correctly.
            </div>
        @endif

        <form action="{{ route('checkout.contact.store') }}" method="POST">
            @csrf

            <section class="mt-10 grid grid-cols-1 gap-10 lg:grid-cols-2">
                <div>
                    <h2 class="text-2xl font-semibold text-[#2B662D]">Contact Information</h2>

                    <div class="mt-8">
                        <p class="text-sm font-semibold text-[#555]">Personal data</p>

                        <div class="mt-3">
                            <input type="text" name="full_name" value="{{ old('full_name', auth()->user()?->name) }}"
                                class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                placeholder="First and last name *" />
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div>
                                <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                    placeholder="Email *" />
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                    placeholder="Phone number *" />
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <p class="text-sm font-semibold text-[#555]">Shipping address</p>

                        <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <div>
                                <select name="city"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm">
                                    <option value="">Select city *</option>
                                    <option value="Presov" {{ old('city') === 'Presov' ? 'selected' : '' }}>Prešov
                                    </option>
                                    <option value="Bratislava" {{ old('city') === 'Bratislava' ? 'selected' : '' }}>
                                        Bratislava</option>
                                    <option value="Kosice" {{ old('city') === 'Kosice' ? 'selected' : '' }}>Košice
                                    </option>
                                </select>
                                @error('city')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <input type="text" name="street" value="{{ old('street') }}"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                    placeholder="Street, house number *" />
                                @error('street')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                    placeholder="PSČ *" />
                                @error('postal_code')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <select name="country"
                                    class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm">
                                    <option value="Slovenská republika" selected>Slovakia</option>
                                </select>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @guest
                        <div class="mt-10">
                            <p class="text-sm font-semibold text-[#555]">Account for future orders</p>

                            <div class="mt-3 flex flex-col gap-3 text-sm text-[#555]">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="create_account" value="1"
                                        {{ old('create_account') == '1' ? 'checked' : '' }} class="accent-[#2B662D]" />
                                    Create an account for faster ordering
                                </label>

                                <label class="flex items-center gap-2">
                                    <input type="radio" name="create_account" value="0"
                                        {{ old('create_account', '0') == '0' ? 'checked' : '' }}
                                        class="accent-[#2B662D]" />
                                    Don't create an account today
                                </label>
                            </div>
                        </div>

                        <div id="account-password-fields" class="mt-4 hidden">
                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                <div>
                                    <input type="password" name="password"
                                        class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                        placeholder="Password" />
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <input type="password" name="password_confirmation"
                                        class="w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm"
                                        placeholder="Repeat password" />
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>

                <div>
                    <h2 class="text-2xl font-semibold text-[#2B662D]">Order Information</h2>

                    <div class="mt-8">
                        <p class="text-sm font-semibold text-[#555]">Note</p>
                        <textarea name="note" class="mt-3 min-h-[280px] w-full rounded-md border border-[#D9D9D9] px-3 py-3 text-sm">{{ old('note') }}</textarea>
                        @error('note')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-12 flex items-center justify-end gap-3">
                        <a href="{{ route('cart') }}"
                            class="rounded-full border border-[#D9D9D9] px-6 py-3 font-semibold text-[#333]">
                            Back
                        </a>

                        <button type="submit" class="rounded-full bg-[#2B662D] px-6 py-3 font-semibold text-white">
                            Continue to Payment
                        </button>
                    </div>
                </div>
            </section>
        </form>
    </main>
</body>

</html>
<script>
    const createAccountRadios = document.querySelectorAll('input[name="create_account"]');
    const passwordFields = document.getElementById('account-password-fields');

    function togglePasswordFields() {
        const selected = document.querySelector('input[name="create_account"]:checked')?.value;
        passwordFields.classList.toggle('hidden', selected !== '1');
    }

    createAccountRadios.forEach((radio) => {
        radio.addEventListener('change', togglePasswordFields);
    });

    togglePasswordFields();
</script>
