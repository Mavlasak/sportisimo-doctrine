<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

interface NewTrademarkFormFactory
{
    function create(): NewTrademarkFormControl;
}
