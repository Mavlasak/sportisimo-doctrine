<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

use App\Entity\Trademark;

class NewTrademarkFormData
{
    public string $name;

    public function toEntity(): Trademark
    {
        return new Trademark($this->name);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
