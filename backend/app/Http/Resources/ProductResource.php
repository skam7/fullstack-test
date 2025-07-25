<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            
            // Opcional: relaciones cargadas
            'category' => $this->whenLoaded('category', function() {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name
                ];
            }),
            
            // Opcional: links HATEOAS
            'links' => [
                'self' => route('products.show', $this->id),
                'index' => route('products.index'),
            ]
        ];
    }
}