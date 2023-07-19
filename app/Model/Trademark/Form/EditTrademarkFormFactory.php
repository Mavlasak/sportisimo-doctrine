<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

use App\Entity\Trademark;

interface EditTrademarkFormFactory
{
    function create(Trademark $trademark): EditTrademarkFormControl;
}
