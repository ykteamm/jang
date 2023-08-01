<?php

namespace App\Services;

use App\Models\ElchiElexir;
use App\Models\Product;
use App\Models\Shop as ShopEntity;
use Illuminate\Support\Facades\Auth;

class Shop
{
    private $price;
    private $totalElixir;
    private $productId;

    public function __construct(int $product_id)
    {
        $this->productId = $product_id;
        $product = Product::where('id', $product_id);
        $this->setPrice((int)$product->value('elixir'));
        $this->totalElixir = (int)ElchiElexir::where('user_id', Auth::id())->value('elexir');
    }

    public function __invoke(): bool
    {
        if ($this->inspection()) {
            $this->elixirUpdate();
            $this->addShop();
            return true;
        }
        return false;
    }

    public function getPrice() {
        return $this->price;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function inspection(): bool
    {
        if ($this->totalElixir < $this->price) {
            return false;
        }
        return true;
    }
    private function elixirUpdate(): void
    {
        $elchiElixir = ElchiElexir::where('user_id', Auth::id());

        $elchiElixir->update(['elexir' => $this->totalElixir - $this->price]);
    }
    private function addShop(): bool
    {
        $shop = new ShopEntity([
            'user_id' => Auth::id(),
            'product_id' => $this->productId
        ]);
        return $shop->save();
    }
}
