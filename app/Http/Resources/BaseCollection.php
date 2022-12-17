<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    public static $wrap = 'records';

    public function with($request): array
    {
        return [
            'status' => 200
        ];
    }

    /**
     * Customize the response for a request.
     *
     * @param mixed|Request $request
     * @param mixed|JsonResponse $response
     * @return void
     */
    public function withResponse($request, $response): void
    {
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_UNESCAPED_UNICODE);
    }
}
