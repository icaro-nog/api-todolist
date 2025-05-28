<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     title="Task",
 *     description="Task entity model",
 *     required={"title", "status"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Comprar pão"),
 *     @OA\Property(property="description", type="string", nullable=true, example="Pão integral no mercado"),
 *     @OA\Property(property="status", type="integer", enum={1,2,3}, example=1, description="1 = Pendente, 2 = Em andamento, 3 = Concluído"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-05-27T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-05-27T12:00:00Z")
 * )
 */

class Task extends Model
{
    protected $table = "tasks";
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
