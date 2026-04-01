<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
</head>
<body class="font-[Manrope]">
    <main class="flex flex-col items-center gap-16 px-3 py-3">
        <p class="font-bold">Dopamine.</p>

        <div class="inset-0 z-50 flex w-[90%] items-center justify-center sm:w-[80%]">
            <div
                class="relative z-10 w-[90%] max-w-lg rounded-xl bg-[#F5F5F5] px-6 py-6 shadow-xl sm:w-[80%]"
            >
                <p class="mb-4 text-2xl font-semibold sm:text-4xl">Start Your <span class="text-[#2B662D]">Premium</span> <br />Experience</p>

                @if ($errors->any())
                    <div
                        class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                    >
                        Please fill in the form correctly.
                    </div>
                @endif

                <form
                    action="{{ route('register.store') }}"
                    method="POST"
                    class="flex flex-col gap-3"
                >
                    @csrf

                    <div class="flex flex-col gap-1">
                        <label for="name" class="mb-1 block text-sm font-medium"> Username </label>
                        <input
                            class="rounded-xl border border-[#D9D9D9] p-2"
                            type="text"
                            placeholder="Username"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                        />
                        @error ('name')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email" class="mb-1 block text-sm font-medium"> Email </label>
                        <input
                            class="rounded-xl border border-[#D9D9D9] p-2"
                            type="email"
                            placeholder="Email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                        />
                        @error ('email')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password" class="mb-1 block text-sm font-medium">
                            Password
                        </label>
                        <input
                            class="rounded-xl border border-[#D9D9D9] p-2"
                            type="password"
                            placeholder="Password"
                            id="password"
                            name="password"
                        />
                        @error ('password')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password_confirmation" class="mb-1 block text-sm font-medium">
                            Repeat Password
                        </label>
                        <input
                            class="rounded-xl border border-[#D9D9D9] p-2"
                            type="password"
                            placeholder="Repeat password"
                            id="password_confirmation"
                            name="password_confirmation"
                        />
                    </div>

                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a
                            href="{{ route('login') }}"
                            class="font-medium text-[#2B662D] hover:underline"
                        >
                            Log in
                        </a>
                    </p>

                    <button type="submit" class="mt-2 rounded-lg bg-[#2B662D] py-3 text-white">
                        Create Account
                    </button>
                </form>
            </div>
        </div>

        <p class="text-sm text-gray-600">
            Changed your mind?
            <a href="{{ route('login') }}" class="font-medium text-[#2B662D] hover:underline">
                Go back
            </a>
        </p>
    </main>
</body>
</html>
