<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/export-products', function () {
    $fileName = 'products_export_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0",
    ];

    $columns = ['Name', 'Price', 'Category', 'Stock'];

    $callback = function () use ($columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        Product::with('category')->chunk(100, function ($products) use ($file) {
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->price,
                    $product->category->name ?? 'N/A',
                    $product->stock,
                ]);
            }
        });

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
});

