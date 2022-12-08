<?php

namespace App\Traits;


use Illuminate\Http\Response;

trait JsonResponseTrait
{

    /**
     * Create team.
     * @param string $message
     * @param array $data
     * @param int $status
     * @return Response
     */
    protected function success(string $message, array $data = [], int $status = 200): Response
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    /**
     * Create team.
     * @param string $message
     * @param int $status
     * @return Response
     */
    protected function failure(string $message, int $status = 400): Response
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

}
