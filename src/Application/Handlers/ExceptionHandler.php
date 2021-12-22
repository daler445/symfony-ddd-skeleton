<?php
declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Exceptions\CatchableException;
use App\Application\Exceptions\HttpExceptions\HttpException;
use App\Application\Exceptions\HttpExceptions\HttpInternalServerErrorException;
use App\Kernel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionHandler extends Kernel
{
	public function onKernelException(ExceptionEvent $event): void
	{
		$exception = $event->getThrowable();

		$httpCode = 500;
		$type = (new HttpInternalServerErrorException('', ''))->getType();
		$errorUniqueCode = '';
		$errorDescription = '';
		$details = [];

		if ($exception instanceof HttpException) {
			$httpCode = $exception->getHttpCode();
			$type = $exception->getType();
			$errorUniqueCode = $exception->getUniqueCode();
			$errorDescription = $exception->getErrorDescription();
			$details = $exception->getDetails();
		}

		if ($exception instanceof CatchableException && !$exception instanceof HttpException) {
			$errorUniqueCode = $exception->getUniqueCode();
			$errorDescription = $exception->getErrorDescription();
			$details = $exception->getDetails();
		}

		if ($this->isDebug()) {
			$errorDescription = $exception->getMessage() . ' at file ' . $exception->getFile() . ' on line ' . $exception->getLine();
		}

		$response = new ActionPayload(
			$httpCode,
			null,
			new ActionError($type, $errorUniqueCode, $errorDescription, $details)
		);

		$event->setResponse(new JsonResponse($response, $httpCode));
	}
}
