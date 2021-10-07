<?php

namespace App\Http\Resources;

use App\Models\App;
use Illuminate\Http\Resources\Json\JsonResource;

class AppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $ret = [];
        
        foreach ($this->resource as $item) {
            $keyTokens = explode('.', $item->getKey());
            
            $ref = &$ret;
            foreach ($keyTokens as $keyToken) {
                if (!isset($ref[$keyToken])) {
                    $ref[$keyToken] = [];
                }
                $ref = &$ref[$keyToken];
            }
            $ref = $item->getValue();
        }
        
        return $ret;
    }
}
