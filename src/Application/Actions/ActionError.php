<?php
declare(strict_types=1);

namespace App\Application\Actions;

use JsonSerializable;

class ActionError implements JsonSerializable
{
	private string $type;
	private ?string $errorUniqueCode;
	private ?string $errorDescription;
	private array $errorDetails;

	/**
	 * ActionError constructor.
	 *
	 * @param string      $type
	 * @param string|null $errorUniqueCode
	 * @param string|null $errorDescription
	 * @param array       $errorDetails
	 */
	public function __construct(string $type, ?string $errorUniqueCode, ?string $errorDescription, array $errorDetails)
	{
		$this->type = $type;
		$this->errorUniqueCode = $errorUniqueCode;
		$this->errorDescription = $errorDescription;
		$this->errorDetails = $errorDetails;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return string|null
	 */
	public function getErrorUniqueCode(): ?string
	{
		return $this->errorUniqueCode;
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
	public function getErrorDetails(): array
	{
		return $this->errorDetails;
	}

	public function jsonSerialize(): array
	{
		return [
			'type' => $this->getType(),
			'code' => $this->getErrorUniqueCode(),
			'description' => $this->getErrorDescription(),
			'details' => $this->getErrorDetails(),
		];
	}
}
