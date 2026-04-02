<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public Product $product;
    public bool $admin;

    public function __construct(Product $product, bool $admin)
    {
        $this->product = $product;
        $this->admin = $admin;
    }

    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
