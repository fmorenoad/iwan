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
            /* 'type' => 'pases diarios',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'identificador' => (string) $this->resource->Identificador,
                'fecha' => (string) $this->resource->Fecha,
                'patente' => (string) $this->resource->Patente,
                'deuda' => (integer) $this->resource->Deuda,
                'deuda_tag' => (integer) $this->resource->DeudaTag,
                'categoria' => (integer) $this->resource->Categoria,
                'tipo_patente' => (integer) $this->resource->TipoPatente
            ],
            'links' => [
                'self' => route('api.v1.pases_diarios.show', $this->resource)
            ] */
                'identificador' => (string) $this->resource->Identificador,
                'fecha' => (string) $this->resource->Fecha,
                'patente' => (string) $this->resource->Patente,
                'deuda' => (integer) $this->resource->Deuda,
                'deuda_tag' => (integer) $this->resource->DeudaTag,
                'categoria' => (integer) $this->resource->Categoria,
                'tipo_patente' => (integer) $this->resource->TipoPatente
        ];
    }
}
