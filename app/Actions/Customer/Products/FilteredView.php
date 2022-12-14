<?php

namespace App\Actions\Customer\Products;

use App\Models\Products;

class FilteredView
{
	public function __construct(
		private Products $product,
	) {
	}

	public function execute(string $command, $products, $search)
	{
		return $command == 'search'
			? $this->searchByProductName($products, $search)
			: ($command == 'filter'
				? $this->FilterProducts($products, $search)
				: null);
	}
	private function searchByProductName($products, $search)
	{
		return $products->where('name', 'like', "%{$search}%");
	}

	private function FilterProducts($products, $search)
	{
	}
}
