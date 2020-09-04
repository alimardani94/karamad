<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactForm
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $cell
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereUpdatedAt($value)
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactForm whereUserId($value)
 */
class ContactForm extends Model
{
    //
}
