<?php
namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
trait ExceptionTrait
{
    public function apiException($request ,$e)
    {
        if($this->isModel($e)){
            return $this->modelResponse($e);
        }
            if($this->isNotFound($e)){
             return $this->httpResponse($e);    
        }
        return parent::render($request, $e);
    }
    public function isModel($e){
        return $e instanceof ModelNotFoundException;
    }
    public function isNotFound($e){
        return $e instanceof NotFoundHttpException;
    }
    public function modelResponse($e){
        return response()->json([
            'errors' => 'model not found'
        ],Response::HTTP_NOT_FOUND);
    }
    public function httpResponse($e){
        return response()->json([
            'errors' => 'incorrect route'
        ],Response::HTTP_NOT_FOUND); 
    }
}