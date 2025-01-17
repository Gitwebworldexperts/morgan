<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Banners;
use App\Models\RentPropertie;
use App\Models\BuyPropertie;

class DownloadImageJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $imageUrl;
    protected $property;
    protected $propertyType;
    protected $key;

    /**
     * Create a new job instance.
     *
     * @param string $imageUrl
     * @param \App\Models\RentPropertie|\App\Models\BuyPropertie $property
     * @param string $propertyType
     * @param string $key
     */
    public function __construct($imageUrl, $property, $propertyType, $key)
    {
        $this->imageUrl = $imageUrl;
        $this->property = $property;
        $this->propertyType = $propertyType;
        $this->key = $key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imageResponse = Http::get($this->imageUrl);
        $timestamp = now()->timestamp;
        $extension = 'png';
        $newFileName = 'image_' . $timestamp . $this->key . '.' . $extension;
        $imagePath = 'images/' . $newFileName;
        file_put_contents($imagePath, $imageResponse->body());

        // Store image in the banners table
        $banner = new Banners();
        $banner->image_url = 'images/' . $newFileName;
        $banner->page_type = $this->propertyType;
        $banner->property_id = $this->property->id;
        $banner->save();

        // Set the first image as featured
        if (empty($this->property->featured_image)) {
            $this->property->featured_image = 'images/' . $newFileName;
        }
    }
}
