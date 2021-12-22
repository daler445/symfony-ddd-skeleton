<?php
declare(strict_types=1);

namespace App\Application\Exceptions;

use Exception;

abstract class CatchableException extends Exception
{
	protected ?string $uniqueCode = null;
	protected ?string $errorDescription = null;
	protected array $details = [];

	/**
	 * @param string|null $uniqueCode
	 */
	public function setUniqueCode(?string $uniqueCode): void
	{
		$this->uniqueCode = $uniqueCode;
	}

	/**
	 * @param string|null $errorDescription
	 */
	public function setErrorDescription(?string $errorDescription): void
	{
		$this->errorDescription = $errorDescription;
	}

	/**
	 * @param array $details
	 */
	public function setDetails(array $details): void
	{
		$this->details = $details;
	}

	/**
	 * @return string|null
	 */
	public function getUniqueCode(): ?string
	{
		return $this->uniqueCode;
	}

	/**
	 * @return string|null
	 */
	public function getErrorDescription(): ?string
	{
		return $this->errorDescription;
	}

	/**
	 * @return array
	 */
	public function getDetails(): array
	{
		return $this->details;
	}
}
