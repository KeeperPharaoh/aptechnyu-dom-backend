<?php

namespace App\Http\Controllers;

use App\Http\Resources\BenefitCollection;
use App\Http\Resources\BlockResource;
use App\Http\Resources\FooterIcoCollection;
use App\Http\Resources\MainContentResource;
use App\Http\Resources\SliderCollection;
use App\Models\Address;
use App\Models\Benefit;
use App\Models\FooterContact;
use App\Models\IconFooter;
use App\Models\MainContent;
use App\Models\Slider;
use App\Models\StockBlock;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function mainContent(): \Illuminate\Http\JsonResponse
    {
        $main = MainContent::first();
        return response()->json(new MainContentResource($main));
    }

    public function slider()
    {
        $slider = Slider::all();
        return response()->json(new SliderCollection($slider));
    }

    public function benefit()
    {
        $benefits = Benefit::all();
        return response()->json(new BenefitCollection($benefits));
    }

    public function firstBlock()
    {
        $stocks = StockBlock::first();
        return response()->json(new BlockResource($stocks),);
    }

    public function secondBlock()
    {
        $stocks = StockBlock::skip(1)->first();
        return response()->json(new BlockResource($stocks),);
    }

    public function footerContact()
    {
        $contact = FooterContact::first();

        return response()->json($contact,200);
    }

    public function footerContent()
    {
        $content = IconFooter::all();
        return response()->json(new FooterIcoCollection($content));
    }

    public function addresses()
    {
        $addresses = Address::all();
        return response()->json($addresses,200);
    }


}
