<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;

class EditTrademarkFormControl extends Control
{
    public array $onSave = [];
    private EditTrademarkFormData $formData;

    public function __construct(
        EditTrademarkFormData $formData,
    ) {
        $this->formData = $formData;
    }

    protected function createComponentEditForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Značka:');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = [$this, 'processForm'];
        $form->setDefaults($this->formData->toArray());

        return $form;
    }

    public function processForm(Form $form): void
    {
        $this->onSave($form->getValues(EditTrademarkFormData::class));
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/edit.latte');
    }
}
