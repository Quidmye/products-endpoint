<?php

namespace Quidmye\ProductsEndpoint\App\Jobs\Products;

use Quidmye\ProductsEndpoint\App\Models\Products\ProductsFormatting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateYMLFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $formatter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ProductsFormatting $productsFormatting)
    {
        $this->formatter = $productsFormatting;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->formatter->update([
                'status' => ProductsFormatting::STATUS_IN_PROGRESS
            ]);

            $categories = $this->formatter->products->map(function ($item){
                return $item->category;
            });
            $fileName = 'products/ymls/' . $this->formatter->id . '.yml';
            $file = Storage::put( 'public/' . $fileName, view('yml.Products.list', [
                'products' => $this->formatter->products,
                'categories' => $categories
            ]));

            $this->formatter->update([
                'status' => ProductsFormatting::STATUS_SUCCESS,
                'yml_path' => $fileName
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            $this->formatter->update([
                'status' => ProductsFormatting::STATUS_FAILED
            ]);
        }
    }
}
