<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;

class NewTrademarkFormControl extends Control
{
    public array $onSave = [];

    protected function createComponentNewForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Značka:');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }

    public function processForm(Form $form): void
    {
        $this->onSave($form->getValues(NewTrademarkFormData::class));
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/new.latte');
    }
}
