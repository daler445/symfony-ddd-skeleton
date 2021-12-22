<?php
declare(strict_types=1);

namespace App\Application\Exceptions\HttpExceptions;

use App\Application\Exceptions\CatchableException;

abstract class HttpException extends CatchableException
{
	protected int $httpCode;
	public string $type = '';

	/**
	 * HttpException constructor.
	 *
	 * @param string $uniqueCode
	 * @param string $description
	 * @param array  $details
	 */
	public function __construct(string $uniqueCode, string $description, array $details = [])
	{
		parent::__construct('',0);
		$this->setUniqueCode($uniqueCode);
		$this->setErrorDescription($description);
		$this->setDetails($details);
	}

	/**
	 * @return int
	 */
	public function getHttpCode(): int
	{
		return $this->httpCode;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}
