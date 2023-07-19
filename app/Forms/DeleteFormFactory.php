<?php declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;

class DeleteFormFactory
{
    public function create(): Form
    {
        $form = new Form;
        $form->addSubmit('submit', 'Smazat');

        return $form;
    }
}
