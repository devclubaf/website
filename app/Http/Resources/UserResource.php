<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\User;
class UserResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nickname' => $this->nickname,
            'location' => $this->location,
            'avatar' => $this->avatar,
            'html_url' => $this->html_url,
        ];
    }
}
