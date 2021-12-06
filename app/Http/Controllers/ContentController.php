<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Benefit;
use App\Models\FooterContact;
use App\Models\FooterContent;
use App\Models\IconFooter;
use App\Models\MainContent;
use App\Models\Slider;
use App\Models\StockBlock;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function mainContent()
    {
        $main = MainContent::first();

        return response()->json($main,200);
    }

    public function slider()
    {
        $slider = Slider::all();
        return response()->json($slider,200);
    }

    public function benefit()
    {
        $benefits = Benefit::all();
        return response()->json($benefits,200);
    }

    public function firstBlock()
    {
        $stocks = StockBlock::first();
        return response()->json($stocks,200);
    }

    public function secondBlock()
    {
        $stocks = StockBlock::skip(1)->first();
        return response()->json($stocks,200);
    }

    public function footerContact()
    {
        $contact = FooterContact::first();

        return response()->json($contact,200);
    }

    public function footerContent()
    {
        $content = IconFooter::all();
        return response()->json($content,200);
    }

    public function addresses()
    {
        $addresses = Address::all();
        return response()->json($addresses,200);
    }


}
