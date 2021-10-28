<?php

declare(strict_types=1);

namespace App\Http\Resources\Site;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class QuizCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
