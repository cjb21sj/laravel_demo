<?php
namespace App\Helper;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;
	 
trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        if (in_array($this->getStatusCode(), [400, 401])) {
            $header = [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => "Origin, X-Requested-With, Content-Type, Accept , Authorization",
                'Access-Control-Allow-Methods' => "GET, POST, OPTIONS, PUT"
            ];
        }

        return Response::json($data,$this->getStatusCode(),$header);
    }

    /**
     * @param $status
     * @param array $data
     * @param int $msgCode
     * @return mixed
     */
    public function status($status, array $data, $msgCode = FoundationResponse::HTTP_OK){

        if (FoundationResponse::HTTP_OK != $this->getStatusCode()) {
            $msgCode = $this->getStatusCode();
        }

        $status = [
            'status' => $status,
            'code' => $msgCode
        ];

        $data = array_merge($status,$data);
        return $this->respond($data);

    }

    /**
     * @param string $status
     * @param int $code
     * @param $message
     * @return mixed
     */
    public function failed($code = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error', $message = []){

        Log::debug('failed-error:' . $status);

        return $this->setStatusCode($code)->message($message,$status);
    }

    /**
     * @param $message
     * @param string $status
     * @return mixed
     */
    public function message($message, $status = "success"){

        return $this->status($status,[
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function internalError($message = "Internal Error!"){

        return $this->failed($message,FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created($message = [])
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)
            ->message($message);

    }

    /**
     * @param array $message
     * @return mixed
     */
    public function deleted($message = [])
    {
        return $this->setStatusCode(FoundationResponse::HTTP_NO_CONTENT)
            ->message($message);

    }

    /**
     * @param $data
     * @param string $status
     * @return mixed
     */
    public function success($data, $status = "success"){

        return $this->status($status,compact('data'));
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message,Foundationresponse::HTTP_NOT_FOUND);
    }
}
