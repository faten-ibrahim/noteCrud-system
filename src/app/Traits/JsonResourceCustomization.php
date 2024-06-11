<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait JsonResourceCustomization
{
    private $statusCode;

    /**
     * with
     *
     * @param  mixed $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => 'true',
            'status_code' => $this->statusCode,
        ];
    }

    /**
     * setStatusCode
     *
     * @param  int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}
