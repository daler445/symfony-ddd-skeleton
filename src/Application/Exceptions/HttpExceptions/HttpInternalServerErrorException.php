<?php
declare(strict_types=1);

namespace App\Application\Exceptions\HttpExceptions;

final class HttpInternalServerErrorException extends HttpException
{
	protected int $httpCode = 400;
	public string $type = 'Internal server error';
}
