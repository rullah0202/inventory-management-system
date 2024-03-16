<?php
namespace App\Helper;

use Illuminate\Http\Request;
use App\Models\Language;
use File;

class Helpers
{
    public static function read_json()
    {        
        if(!session()->get('session_short_name')) {
            $default_lang_data = Language::where('is_default','Yes')->first();
            $current_short_name = $default_lang_data->short_name;
        }
        else 
        {
            $current_short_name = session()->get('session_short_name');
            // $language_data = Language::where('short_name',$current_short_name)->first();
        }

        // if(!$language_data){
        //     $json_data = json_decode(file_get_contents(resource_path('languages/en.json')));
        //     foreach($json_data as $key=>$value) {
        //         define($key,$value);
        //     }
        // }
        // else{
            $json_data = json_decode(file_get_contents(resource_path('languages/'.$current_short_name.'.json')));
            foreach($json_data as $key=>$value) {
                define($key,$value);
            // }
        }

    }
}