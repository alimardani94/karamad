<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Model
     */
    public $entity;

    /**
     * @var array
     */
    public $images;

    /**
     * Create a new job instance.
     *
     * @param Model $entity
     * @param array $images
     */
    public function __construct(Model $entity, array $images)
    {
        $this->entity = $entity;
        $this->images = $images;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $oldImages = json_decode($this->entity->images, true);

        $thumbs = [];
        $dir = $this->entity->getTable() . '/' . $this->entity->id;

        Storage::makeDirectory($dir);

        foreach ($this->images as $tempPath) {
            if (strpos($tempPath, asset('storage/')) !== false) {
                $imgName = trim(str_replace(asset('storage/'), '', $tempPath), '/');
                foreach ($oldImages as $i => $oldImage) {
                    if (in_array($imgName, $oldImage)) {
                        $thumbs[] = $oldImage;
                    }
                }
            } else {
                $imgName = substr($tempPath, 16);

                $arr = [
                    'original' => $dir . '/' . $imgName
                ];

                foreach (config('image.thumbs.' . $this->entity->getTable()) as $key => $thumb) {
                    $arr[$key] = $dir . '/' . $thumb['prefix'] . $imgName;

                    $img = Image::make(storage_path('app/public/' . $tempPath));
                    $img->resize($thumb['width'], $thumb['height']);
                    $img->save(storage_path('app/public/' . $arr[$key]));
                }

                Storage::move($tempPath, $arr['original']);

                $thumbs[] = $arr;
            }
        }

        $this->entity->images = json_encode($thumbs);
        $this->entity->save();
    }
}
