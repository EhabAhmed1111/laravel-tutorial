<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{

    // this will stop the laravel from wraping all data inside data object
    // public static $wrap=null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // $this here refer to the model that you will use in our case its Post model  
            'id'=>$this->id,
            'body'=>$this->body,
            'title'=>$this->title,
            'created_at'=>$this->created_at->format("Y-m-d H:i:s"),
            'updated_at'=>$this->updated_at->format("Y-m-d H:i:s"),
            // this lazy load 
            // so it will not load user untill you ask for the user
            'author'=>new UserResource($this->whenLoaded('author'))
        ]; 
    }   
}
