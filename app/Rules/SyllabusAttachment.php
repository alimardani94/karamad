<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SyllabusAttachment implements Rule
{
    private $titleOfAttachment;

    /**
     * Create a new rule instance.
     * @param array $titleOfAttachment
     */
    public function __construct(array $titleOfAttachment)
    {
        $this->titleOfAttachment = $titleOfAttachment;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return isset($this->titleOfAttachment[(int)str_replace('attachments_files.', '', $attribute)]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'فایل ضمیمه عنوان ندارد';
    }
}
