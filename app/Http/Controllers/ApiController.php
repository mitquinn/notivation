<?php
namespace App\Http\Controllers;

Use Response;
class ApiController extends Controller {
	
	protected $statusCode = 200;

	public function getStatusCode()
		{
			return $this->statusCode;
		}

	public function setStatusCode($statusCode)
		{
			$this->StatusCode = $statusCode;

			return $this;
		}

	public function respondNotFound($message = 'Not found.')
		{
			return $this->setStatusCode(404)->respondWithError($message);
		}

	public function respond($data, $headers = [])
		{
			return Response::json($data, $this->getStatusCode(), $headers);
		}


	public function respondWithError($message)
		{
			return $this->respond([
				'error' => [
					'message' => $message,
					'status_code' => $this->getStatusCode()
				]
			]);
		}

	public function respondWithSuccess($message)
		{
			return $this->respond([
				'success' => [
					'message' => $message,
					'status_code' => $this->getStatusCode()
				]
			]);
		}

	public function respondDeleted($message)
		{
			return $this->respondWithSuccess($message);
		}

}