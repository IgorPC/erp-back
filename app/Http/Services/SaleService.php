<?php

namespace App\Http\Services;

use App\Http\Repositories\SaleRepository;

class SaleService
{
    private $saleRepository;
    private $clientService;
    private $userService;
    private $productService;
    private $productSaleService;
    private $saleStatusService;

    public function __construct(
        SaleRepository $saleRepository,
        ClientService $clientService,
        UserService $userService,
        ProductService $productService,
        ProductSaleService $productSaleService,
        SaleStatusService $saleStatusService
    ) {
        $this->saleRepository = $saleRepository;
        $this->clientService = $clientService;
        $this->userService = $userService;
        $this->productService = $productService;
        $this->productSaleService = $productSaleService;
        $this->saleStatusService = $saleStatusService;
    }

    public function newSale($client, $total, $products, $createdBy)
    {
        if (! $client || ! $total || ! count($products) || ! $createdBy) {
            return [
                'success' => false,
                'data'=> 'Invalid params'
            ];
        }

        $client = $this->clientService->findById($client);

        if (! $client) {
            return [
                'success' => false,
                'data'=> 'Client not found'
            ];
        }

        $user = $this->userService->findUserById($createdBy);

        if (! $user) {
            return [
                'success' => false,
                'data'=> 'User not found'
            ];
        }
        $priceTotal = 0;
        $totalWithoutDiscounts = 0;
        $productList = [];

        foreach ($products as $saleProduct) {
            $product = $this->productService->getProduct($saleProduct['product_id']);
            $price = (double) $saleProduct['price'];

            if ((double) $product->price !== $price) {
                return [
                    'success' => false,
                    'data'=> 'Invalid Product Price'
                ];
            }

            $discount = $price * $saleProduct['discount'] / 100;
            $finalPrice = $price - $discount;
            $priceTotal += $finalPrice * $saleProduct['quantity'];
            $totalWithoutDiscounts += $price * $saleProduct['quantity'];
            $productList[] = [
                'product_id' => $product->id,
                'price' => $price,
                'discount' => $saleProduct['discount'],
                'quantity' => $saleProduct['quantity'],
                'price_after_discount' => $finalPrice
            ];
        }

        $totalDiscount = (double) $totalWithoutDiscounts - (double) $priceTotal;

        if ((double) $total !== $priceTotal) {
            return [
                'success' => false,
                'data'=> 'Invalid Sale Total'
            ];
        }

        $activeStatus = $this->saleStatusService->findByDescription('active');

        if (! $activeStatus) {
            return [
                'success' => false,
                'data'=> 'Invalid Sale Status'
            ];
        }

        $saleBody = [
            'client_id' => $client->id,
            'total' => $priceTotal,
            'discount' => $totalDiscount,
            'status_id' => $activeStatus->id,
            'created_by' => $user->id
        ];

        $sale = $this->saleRepository->createSale($saleBody);

        if (! $sale) {
            return [
                'success' => false,
                'data'=> 'Internal server error'
            ];
        }

        foreach ($productList as $productSale) {
            $productSale['sale_id'] = $sale->id;
            $this->productSaleService->addProductToSale($sale->id, $productSale);
        }

        return [
            'success' => true,
            'data'=> 'Sale completed',
            'sale_id' => $sale->id
        ];
    }
}
