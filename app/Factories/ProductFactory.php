<?php

// app/Factories/ProductFactory.php
namespace App\Factories;

use App\Models\Category;
use App\Models\Product;

class ProductFactory
{
    public static function getProducts(array $filters = [])
    {
        $query = Product::query()->with(['productImages'])->where('status', 'active');
        // Sort products
        switch ($filters['sort'] ?? 'default') {
            case 'asc':
                $query->orderBy('name', 'asc');
                break;
            case 'desc':
                $query->orderBy('name', 'desc');
                break;
            case 'low':
                $query->orderBy('price', 'asc');
                break;
            case 'high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }
        // Filter by category name
        if (!empty($filters['categoryName'])) {
            $category = Category::where('name', $filters['categoryName'])->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by specific categories
        if (!empty($filters['category'])) {
            $categories = explode('|', $filters['category']);
            $query->whereIn('category_id', $categories);
        }

        // Filter by price range
        if (!empty($filters['start_price']) && !empty($filters['end_price'])) {
            $query->whereBetween('price', [$filters['start_price'], $filters['end_price']]);
        }

        // Paginate results
        $perPage = $filters['show'] ?? 12;

        return $query->paginate($perPage);
    }
}
