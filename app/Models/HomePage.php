<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        'eyebrow',
        'title_line_one',
        'title_line_two',
        'description',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'community_text',
    ];
}
