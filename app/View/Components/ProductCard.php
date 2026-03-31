<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class ProductCard extends Component
{
    public $name;
    public $price;
    public $description;
    public $link;

    public function __construct($name, $price, $description, $link)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->link = $link;
    }

    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
