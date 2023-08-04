<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

class EditTrademarkFormData
{
    public function __construct(
        public string $name,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
