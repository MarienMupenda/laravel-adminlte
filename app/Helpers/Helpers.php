<?php

namespace App\Helpers;

use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;
use phpseclib3\Math\PrimeField\Integer;


class Helpers
{

    public static function error()
    {
        return abort(404);
    }

    /*
    public static function uploadItemImageApi(Request $request)
    {
        if ($request->has('image') and $request->has('ext')) {

            $image = $request->input('image');
            $extension = $request->input('ext');

            $image = base64_decode($image);

            $fileNameToStore = time() . '.' . $extension;

            //Create thumbanil
            $thumbnail=Image::make($image->getRealPath());
            $thumbnail->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbnail->stream();
            Storage::put('public/companies/' .  $request->input('company_id') . '/items/'.'thumbnail/' . $fileNameToStore, $thumbnail);

            Storage::put('public/companies/' . $request->input('company_id') . '/items/' . $fileNameToStore, $image);

            return $fileNameToStore;
        } else {
            return "";
        }
    }
    */

    public static function uploadItemImage(Request $request, $company)
    {

        $image = $request->file('image');
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = time() . '.' . $extension;

        //Create thumbnail
        $thumbnail = Image::make($image->getRealPath());
        $thumbnail->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnail->stream();

        //store origrinal and thumbnail
        Storage::put('public/companies/' . $company . '/items/small/' . $fileNameToStore, $thumbnail);
        //Storage::put('public/companies/' . $company . '/items', $fileNameToStore, $image);
        $request->file('image')->storeAs('public/companies/' . $company . '/items', $fileNameToStore);

        return $fileNameToStore;
    }


    public static function uploadItemImageUrl(Request $request, $company)
    {

        $path = $request->image_url;

        $fileNameToStore = time() . '.jpg';


        try {
            $image = file_get_contents($path);
            Storage::put('public/companies/' . $company . '/items/' . $fileNameToStore, $image);
            return $fileNameToStore;
        } catch (NotReadableException $e) {
            return $e;
        }
    }

    public static function profile_image($filename)
    {
        return User::PROFILE_DIR . '/' . $filename;
    }

    public static function profile_image_public($filename)
    {
        return User::PROFILE_DIR_PUCLIC . '/' . $filename;
    }

    public static function number_format_short($n, $precision = 1)
    {
        if ($n < 900000) {
            // 0 - 900
            $n_format = number_format($n, $precision, ',', ' ');
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision, ',', ' ');
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision, ',', ' ');
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision, ',', ' ');
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision, ',', ' ');
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }

    public static function slugify($title, $category, $item_id)
    {
        return Str::slug("$category $item_id $title", '-', 'fr');
    }
}
