<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;

class ProductService
{
    private $productStatusService;
    private $userService;
    private $productRepository;

    public function __construct(
        ProductStatusService $productStatusService,
        UserService $userService,
        ProductRepository $productRepository
    ){
        $this->userService = $userService;
        $this->productStatusService = $productStatusService;
        $this->productRepository = $productRepository;
    }

    public function listWithPagination($rows, $page)
    {
        return $this->productRepository->listWithPagination($page, $rows);
    }

    public function updateProduct($productId, $productData)
    {
        $product = $this->productRepository->findById($productId);

        if (! $product) {
            return [
                'success' => false,
                'data'=> 'Product not found'
            ];
        }

        $status =  $this->productStatusService->findByProductStatusDescription('Active');

        if (! $status) {
            return [
                'success' => false,
                'data'=> 'Status not found'
            ];
        }

        $codeAlreadyExists = $this->productRepository->findByCode($productData['code']);

        if ($codeAlreadyExists && $codeAlreadyExists->code !== $product->code) {
            return [
                'success' => false,
                'data'=> "The code {$productData['code']} already exists in our database"
            ];
        }

        $action = $this->productRepository->update($product->id, $productData);

        if (! $action) {
            return [
                'success' => false,
                'data'=> 'Internal Server Error'
            ];
        }

        return [
            'success' => true,
            'data'=> 'Product Successfully updated'
        ];
    }

    public function createProduct($productData)
    {
        $user = $this->userService->findUserById($productData['user_id']);

        if (! $user) {
            return [
                'success' => false,
                'data'=> 'User not found'
            ];
        }

        $activeStatus = $this->productStatusService->findByProductStatusDescription('Active');

        if (! $activeStatus) {
            return [
                'success' => false,
                'data'=> 'No active status for a product was found in the database'
            ];
        }

        $codeAlreadyExists = $this->productRepository->findByCode($productData['code']);

        if ($codeAlreadyExists) {
            return [
                'success' => false,
                'data'=> "The code {$productData['code']} already exists in our database"
            ];
        }

        $newProduct = [
            'name' => $productData['name'],
            'code' => $productData['code'],
            'price' => $productData['price'],
            'quantity' => $productData['quantity'],
            'status_id' => $activeStatus->id,
            'created_by' => $user->id
        ];

        $product = $this->productRepository->create($newProduct);

        if (! $product) {
            return [
                'success' => false,
                'data'=> 'Internal Server error'
            ];
        }

        return [
            'success' => true,
            'data'=> 'Product Successfully created',
            'product_id' => $product->id
        ];
    }
}
