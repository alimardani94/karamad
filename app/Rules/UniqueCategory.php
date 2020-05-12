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
     * @var int
     */
    private $categoryId;

    /**
     * Create a new rule instance.
     *
     * @param $parent
     * @param int $categoryId
     */
    public function __construct($parent, int $categoryId = null)
    {
        $this->parent = $parent ?? 0;
        $this->categoryId = $categoryId;
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
        return !Category::whereName($value)->whereParentId($this->parent)->where('id', '<>', $this->categoryId)->exists();
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
