<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaseDiarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'pases diarios',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'Identificador' => (string) $this->resource->getRouteKey(),
                'Fecha' => (string) $this->resource->fecha_transito,
                'Patente' => (string) $this->resource->patente,
                'Deuda' => (integer) $this->resource->deuda,
                'Deuda_tag' => (integer) $this->resource->deuda_tag,
                'Categoria' => (integer) $this->resource->id_categoria,
                'Tipo_patente' => (integer) $this->resource->tipo_patente
            ],
            'links' => [
                'self' => route('api.v1.pases_diarios.show', $this->resource)
            ]
        ];
    }
}
