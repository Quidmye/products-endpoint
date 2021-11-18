<?php

namespace Quidmye\ProductsEndpoint\App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use Quidmye\ProductsEndpoint\App\Http\Requests\Products\ProductsFormattingRequest;
use Quidmye\ProductsEndpoint\App\Jobs\Products\CreateYMLFile;
use Quidmye\ProductsEndpoint\App\Models\Products\ProductsFormatting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FormattingController extends Controller
{
    public function format(ProductsFormattingRequest $request){
        try {

            $data = $request->input('products');
            $formatter = ProductsFormatting::create([
                'status' => ProductsFormatting::STATUS_NEW
            ]);
            CreateYMLFile::dispatch($formatter, $data);
            return response()->json([
                'link' => route('format.check', [
                    'id' => $formatter->id
                ])
            ]);
        }catch (\Exception $exception){

            Log::error($exception->getMessage());

            return response()->json([
                'error' => 'Произошла ошибка'
            ], 500);

        }
    }

    public function check($id){
        $formatter = ProductsFormatting::findOrFail($id);

        try {
            if($formatter->status === ProductsFormatting::STATUS_FAILED){
                return response()->json([
                    'error' => 'Произошла ошибка'
                ], 500);
            }
            if($formatter->status !== ProductsFormatting::STATUS_SUCCESS){
                return response()->json([
                    'status' => $formatter->status
                ], 202);
            }
            return response()->json([
                'status' => $formatter->status,
                'link' => url(Storage::url($formatter->yml_path))
            ]);

        }catch (\Exception $exception){
            return response()->json([
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }
}
