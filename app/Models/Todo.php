<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @method static self create(array $attributes = [])
 * @method static cursorPaginate(int $perPage = null, string $cursor = null)
 * @method static self update(array $values = [])
 */
class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];
}
