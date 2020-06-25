<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shop\Product
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string $description
 * @property string $images
 * @property string|null $features
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $quantity
 * @property string|null $file
 * @property int $discount_type
 * @property int $discount
 * @property string|null $attachment
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereQuantity($value)
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Product whereCategoryId($value)
 */
class Product extends Model
{

}
