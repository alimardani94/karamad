<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactForm
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $email
 * @property string|null $cell
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereUserId($value)
 * @mixin \Eloquent
 */
class ContactForm extends Model
{
    //
}
