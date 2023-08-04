<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

interface EditTrademarkFormFactory
{
    function create(EditTrademarkFormData $formData): EditTrademarkFormControl;
}
