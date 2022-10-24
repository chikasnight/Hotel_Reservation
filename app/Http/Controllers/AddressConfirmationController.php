<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddressConfirmation;

class AddressConfirmationController extends Controller
{
    public function addressConfirmation(Request $request){
        //validate request body
        $request->validate([
            'address_confirmation' => ['mimes:png,jpeg,gif,bmp', 'max:2048','required'],
            

          
        ]);

        //get the image
        $image = $request->file('image');
        //$image_path = $image->getPathName();
 
        // get original file name and replace any spaces with _
        // example: ofiice card.png = timestamp()_office_card.pnp
        $filename = time()."_".preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
 
        // move image to temp location (tmp disk)
        $tmp = $image->storeAs('uploads/address', $filename, 'tmp');
 
 
        //create the upload
        $newDetail = AddressConfirmation::create([
            'user_id'=>auth()->id(),
            'address_confirmation'=> $filename,
            'disk'=> config('site.upload_disk'),
           
            
        ]);

        //dispacth job to handle image manipulation
        $this->dispatch(new AddressUpload($newDetail));

        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully uploaded a file',
            'data' => $newDetail
        ]);
    }
}
