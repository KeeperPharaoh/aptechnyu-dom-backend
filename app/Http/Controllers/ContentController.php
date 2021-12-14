<?php

namespace App\Http\Controllers;

use App\Http\Resources\BenefitCollection;
use App\Http\Resources\BlockResource;
use App\Http\Resources\FooterIcoCollection;
use App\Http\Resources\MainContentResource;
use App\Http\Resources\SliderCollection;
use App\Models\Address;
use App\Models\Benefit;
use App\Models\BonusContent;
use App\Models\CareerContent;
use App\Models\ConditionContent;
use App\Models\FooterContact;
use App\Models\IconFooter;
use App\Models\MainContent;
use App\Models\ProcedureContent;
use App\Models\Slider;
use App\Models\StockBlock;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function mainContent(): \Illuminate\Http\JsonResponse
    {
        $main = MainContent::query()->first();
        return response()->json(new MainContentResource($main));
    }

    public function slider(): \Illuminate\Http\JsonResponse
    {
        $slider = Slider::all();
        return response()->json(new SliderCollection($slider));
    }

    public function benefit(): \Illuminate\Http\JsonResponse
    {
        $benefits = Benefit::all();
        return response()->json(new BenefitCollection($benefits));
    }

    public function firstBlock(): \Illuminate\Http\JsonResponse
    {
        $stocks = StockBlock::query()->first();
        return response()->json(new BlockResource($stocks),);
    }

    public function secondBlock(): \Illuminate\Http\JsonResponse
    {
        $stocks = StockBlock::query()->skip(1)->first();
        return response()->json(new BlockResource($stocks),);
    }

    public function footerContact(): \Illuminate\Http\JsonResponse
    {
        $contact = FooterContact::query()->first();

        return response()->json($contact,200);
    }

    public function footerContent(): \Illuminate\Http\JsonResponse
    {
        $content = IconFooter::all();
        return response()->json(new FooterIcoCollection($content));
    }

    public function addresses(): \Illuminate\Http\JsonResponse
    {
        $addresses = Address::all();
        return response()->json($addresses,200);
    }

    public function career(): \Illuminate\Http\JsonResponse
    {
        $content = CareerContent::query()->first();
        return response()->json($content);
    }

    public function condition(): \Illuminate\Http\JsonResponse
    {
        $content = ConditionContent::query()->first();
        return response()->json($content);
    }

    public function bonusContent(): \Illuminate\Http\JsonResponse
    {
        $content = BonusContent::query()->first();
        return response()->json($content);
    }

    public function procedure(): \Illuminate\Http\JsonResponse
    {
        $content = ProcedureContent::query()->first();
        return response()->json($content);
    }
}
