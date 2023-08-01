<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait FileUploadTrait {
    public function uploadResizeImage($file)
    {
        $x=15;
        $file = $request->file('open_selfi') ;
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $img=\Image::make($file);
        $img->save('images/users/king_sold/'.$imageName,$x);
    }
}