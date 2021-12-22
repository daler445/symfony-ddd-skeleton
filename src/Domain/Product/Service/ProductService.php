<?php
declare(strict_types=1);

namespace App\Domain\Product\Service;

use App\Domain\Domain;
use App\Domain\Product\Product;

class ProductService extends Domain
{
	public function newProduct(string $name, float $price): void
	{
		$this->logger->info(sprintf('Creating new product (name: %s, price: %d)', $name, $price));

		$entityManager = $this->doctrine->getManager();

		$product = new Product();
		$product->setName($name);
		$product->setPrice($price);

		$entityManager->persist($product);
		$entityManager->flush();

		$this->logger->info('Product created');
	}
}
