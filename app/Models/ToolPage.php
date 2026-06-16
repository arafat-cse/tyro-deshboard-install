<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ToolPage extends Model
{
    protected $fillable = [
        'eyebrow',
        'title_line_one',
        'title_line_two',
        'description',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(ToolSection::class)->orderBy('sort_order');
    }
}
