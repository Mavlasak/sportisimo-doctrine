<?php declare(strict_types=1);

namespace App\Model\Trademark;

use App\Entity\Trademark;
use App\Model\Trademark\Exception\TrademarkAlreadyExistException;
use App\Model\Trademark\Form\EditTrademarkFormData;
use App\Model\Trademark\Form\NewTrademarkFormData;

final class TrademarkService
{
    public function __construct(
        private TrademarkRepository $trademarkRepository,
    ) {
    }

    public function createIfNotExist(NewTrademarkFormData $formData): void
    {
        $trademarkExist = $this->trademarkRepository->exist($formData->getName());
        if ($trademarkExist) {
            throw new TrademarkAlreadyExistException();
        }
        $this->trademarkRepository->save($formData->toEntity());
    }

    public function getAllOrderByName(int $limit, int $offset, bool $desc): array
    {
        return $this->trademarkRepository->getAllOrderByName($limit, $offset, $desc);
    }

    public function findOneById(int $id): ?Trademark
    {
        return $this->trademarkRepository->findOneBy(['id' => $id]);
    }

    public function updateIfNotExist(EditTrademarkFormData $formData, Trademark $trademark): void
    {
        $trademarkExist = $this->trademarkRepository->exist($formData->getName());
        if ($trademarkExist) {
            throw new TrademarkAlreadyExistException();
        }
        $trademark->setName($formData->getName());
        $this->trademarkRepository->save($trademark);
    }

    public function delete(Trademark $trademark): void
    {
        $this->trademarkRepository->delete($trademark);
    }

    public function getAllCount(): int
    {
        return $this->trademarkRepository->getAllCount();
    }
}
