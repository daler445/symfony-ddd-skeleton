<?php
declare(strict_types=1);

namespace App\Application\Actions;

use JsonSerializable;

class ActionPayload implements JsonSerializable
{
	private int $statusCode;
	private $data;
	private ?ActionError $error;

	/**
	 * ActionPayload constructor.
	 *
	 * @param int                                       $statusCode
	 * @param null                                      $data
	 * @param \App\Application\Actions\ActionError|null $error
	 */
	public function __construct(int $statusCode = 200, $data = null, ?ActionError $error = null)
	{
		$this->statusCode = $statusCode;
		$this->data = $data;
		$this->error = $error;
	}

	/**
	 * @return int
	 */
	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	/**
	 * @return null
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @return \App\Application\Actions\ActionError|null
	 */
	public function getError(): ?ActionError
	{
		return $this->error;
	}

	/**
	 * @return array|int[]
	 */
	public function jsonSerialize(): array
	{
		$payload = [
			'statusCode' => $this->getStatusCode(),
		];
		if ($this->data !== null) {
			$payload['data'] = $this->data;
		}
		if ($this->error !== null) {
			$payload['error'] = $this->error;
		}

		return $payload;
	}
}
