<?php

namespace App\Models\Shop;

use App\Enums\Shop\ProductType;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * App\Models\Shop\Product
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
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
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereUpdatedAt($value)
 * @mixin \Eloquent
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
     * @return array|Application|Translator|string|null
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
        return $this->belongsTo(Category::class);
    }

    /**
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
