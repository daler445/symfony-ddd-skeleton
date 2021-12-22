<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use App\Application\Actions\Action;
use App\Domain\Product\Service\ProductService;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class CreateProductAction extends Action
{
	private ProductService $productService;

	/**
	 * CreateProductAction constructor.
	 *
	 * @param \Psr\Log\LoggerInterface                   $logger
	 * @param \Doctrine\Persistence\ManagerRegistry      $doctrine
	 * @param \App\Domain\Product\Service\ProductService $productService
	 */
	public function __construct(LoggerInterface $logger, ManagerRegistry $doctrine, ProductService $productService)
	{
		parent::__construct($logger, $doctrine);
		$this->productService = $productService;
	}

	public function action(): Response
	{
		$this->logger->info('Creating new product');

		$this->productService->newProduct('Product #' . time(), random_int(100, 500));

		return $this->respondWithData(['product' => 'created']);
	}
}
