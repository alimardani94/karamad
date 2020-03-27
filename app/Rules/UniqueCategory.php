<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class UniqueCategory implements Rule
{

    /**
     * @var int
     */
    private $parent;

    /**
     * Create a new rule instance.
     *
     * @param $parent
     */
    public function __construct($parent)
    {
        $this->parent = $parent ?? 0;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $duplicate = Category::whereName($value)->whereParentId($this->parent)->exists();

        return !$duplicate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique');
    }
}
