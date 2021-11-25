<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Benefit;
use App\Models\FooterContact;
use App\Models\FooterContent;
use App\Models\MainContent;
use App\Models\StockBlock;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function mainContent()
    {
        $main = MainContent::first();

        return response()->json($main,200);
    }

    public function benefit()
    {
        $benefits = Benefit::all();
        foreach ($benefits as $benefit){
            $benefit->image = self::jsonDecode($benefit->image);
        }
        return response()->json($benefits,200);
    }

    public function stockBlock()
    {
        $stocks = StockBlock::all()->take(2);
        return response()->json($stocks,200);
    }

    public function footerContact()
    {
        $contact = FooterContact::first();

        return response()->json($contact,200);
    }

    public function footerContent()
    {
        $content = FooterContent::first();
        $content->youtube_image = self::jsonDecode($content->youtube_image);
        $content->instagram_image = self::jsonDecode($content->instagram_image);
        $content->facebook_image = self::jsonDecode($content->facebook_image);
        return response()->json($content,200);
    }

    public function addresses()
    {
        $addresses = Address::all();
        return response()->json($addresses,200);
    }

    public static function jsonDecode($json){
        $json = json_decode($json, true);
        return 'storage/' .$json[0]['download_link'];
    }
}
