<?php

namespace App\Models;

use App\Enums\Shop\ProductStatus;
use App\Enums\Shop\ProductType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property int $category_id
 * @property int $status
 * @property int $type
 * @property int|null $quantity
 * @property string|null $file
 * @property int $price
 * @property int $discount_type
 * @property int $discount
 * @property string|null $attachment
 * @property string|null $features
 * @property string|null $description
 * @property string $images
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $summery
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSummery($value)
 */
class Product extends Model
{
    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return slugify($this->name);
    }

    /**
     * @return string|null
     */
    public function status()
    {
        return ProductStatus::translatedKeyOf($this->status);
    }

    /**
     * @return string|null
     */
    public function type()
    {
        return ProductType::translatedKeyOf($this->type);
    }

    /**
     * @return array
     */
    public function images()
    {
        $arr = json_decode($this->images, true);
        $images = [];

        foreach ($arr as $img) {
            $images[] = asset('media/' . $img);
        }

        return $images;
    }

    /**
     * @return mixed|string
     */
    public function image()
    {
        return $this->images()[0] ?? '';
    }

    /**
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @return MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * @return mixed
     */
    public function features()
    {
        return json_decode($this->features, true);
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
