<?php


namespace App\Services;
use Storage;
use DOMDocument;
use Image;
class RichTextService
{
    public function store($data, $directory, $id)
    {
        if($data) {
            $content_dir = 'richtext/' . $directory . '/' .$id . '/';
            Storage::makeDirectory('public/' . $content_dir);
            $dom = new DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML(mb_convert_encoding($data, 'HTML-ENTITIES', 'UTF-8'));
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');



            // foreach <img> in the submited message
            foreach($images as $img){
                $src = $img->getAttribute('src');

                // if the img source is 'data-url'
                if(preg_match('/data:image/', $src)){

                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    // Generating a random filename

                    $filename = uniqid();
                    $filepath = $content_dir.$filename.'.'.$mimetype;

                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                        // resize if required
                        /* ->resize(300, 200) */
                        ->encode($mimetype, 100) 	// encode file to the specified mimetype
                        ->save((storage_path('app/public/').$filepath));

                    $new_src = 'storage/' . $content_dir . $filename.'.'.$mimetype;
                    //dd($new_src);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } else {
                    $new_src = '../' .  $src;
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                } // <!--endif
            } // <!--endforeach
            $return =  $dom->saveHTML();
        } else {
            $return = '';
        }


        return   $return;
    }
}
