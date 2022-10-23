<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'availableRoom_id',
        'image',
        'upload_successful',
        'disk',
    ];
    
    public function pictures(){
        return$this->belongsTo(AvailableRoom::class);
    }
    public function getImagesAttribute()
    {
        return [
            "original" => $this->getImagePath("gallery"),
        ];
    }

    public function getImagePath($size)
    {
        return Storage::disk($this->disk)->url("uploads/gallery/{$size}/" . $this->image);
    }
}
