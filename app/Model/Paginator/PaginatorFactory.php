<?php declare(strict_types=1);

namespace App\Model\Paginator;

use Nette\Utils\Paginator;

class PaginatorFactory
{
    public function create(int $itemsCount, int $itemPerPage, int $page): Paginator
    {
        $paginator = new Paginator;
        $paginator->setItemCount($itemsCount);
        $paginator->setItemsPerPage($itemPerPage);
        $paginator->setPage($page);

        return $paginator;
    }
}
