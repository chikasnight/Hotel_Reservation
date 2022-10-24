<?php

namespace App\Jobs;

use App\Models\AddressConfirmation;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Bus\Queueable;
use Image;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AddressUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $addressConfirmation;

    public function __construct(AddressConfirmation $addressConfirmation)
    {
        $this->addressConfirmation = $addressConfirmation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = $this->addressConfirmation->disk;
        //Log::info("Disk: " . $disk);
        $imageName = $this->addressConfirmation->image;
        $original_file = storage_path() . '/uploads/address/' . $imageName;

        try {
          
            // store images to permanent disk

            // Original
            if (Storage::disk($disk)->put('/uploads/original/' . $imageName, fopen($original_file, 'r+'))) {
                File::delete($original_file);
            }

            // update database record with success flag
            $this->addressConfirmation->update([
                'upload_successful' => true
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
