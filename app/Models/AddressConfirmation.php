<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddressConfirmation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address_confirmation',
        'address_verified_at',
        'upload_successfull',
        'disk'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getImagesAttribute()
    {
        return [
            "original" => $this->getImagePath("original"),
        ];
    }

    public function getImagePath($size)
    {
        return Storage::disk($this->disk)->url("uploads/original/{$size}/" . $this->image);
    }


}
