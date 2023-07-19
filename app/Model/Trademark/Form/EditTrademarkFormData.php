<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

class EditTrademarkFormData
{
    public string $name;

    public function getName(): string
    {
        return $this->name;
    }
}
