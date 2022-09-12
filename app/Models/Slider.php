<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title','title_font_size','title_font_color','description','description_font_size','description_font_color','text_align','link','image'
    ];
}
