<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config("app.name", "Laravel") }}</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body>
        <div
            id="productsGrid"
            class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
        >
            <x-product-card name="Lemon" price="2.90" />
            <x-product-card name="Orange" price="2.90" />
            <x-product-card name="Peach" price="2.90" />
            <x-product-card name="Apple" price="2.90" />
        </div>
    </body>
</html>
