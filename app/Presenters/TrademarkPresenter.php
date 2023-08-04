<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Entity\Trademark;
use App\Forms\DeleteFormFactory;
use App\Model\Paginator\PaginatorFactory;
use App\Model\Trademark\Exception\TrademarkAlreadyExistException;
use App\Model\Trademark\Form\EditTrademarkFormData;
use App\Model\Trademark\Form\NewTrademarkFormControl;
use App\Model\Trademark\Form\EditTrademarkFormControl;
use App\Model\Trademark\Form\NewTrademarkFormData;
use App\Model\Trademark\Form\NewTrademarkFormFactory;
use App\Model\Trademark\Form\EditTrademarkFormFactory;
use App\Model\Trademark\TrademarkService;
use Nette;
use Nette\Application\UI\Form;

final class TrademarkPresenter extends Nette\Application\UI\Presenter
{
    public const ITEM_PER_PAGE_STEP = 5;
    public const MAX_ITEM_PER_PAGE = 100;

    private Trademark $trademark;

    public function __construct(
        private TrademarkService $trademarkService,
        private NewTrademarkFormFactory $newTrademarkFormFactory,
        private EditTrademarkFormFactory $editTrademarkFormFactory,
        private PaginatorFactory $paginatorFactory,
        private DeleteFormFactory $deleteFormFactory,
    ) {}

    protected function createComponentDeleteForm(): Form
    {
        $form = $this->deleteFormFactory->create();
        $form->onSuccess[] = function (): void
        {
            $this->trademarkService->delete($this->trademark);
            $this->flashMessage('Značka byla smazána.');
            $this->redirect('index');
        };

        return $form;
    }

    protected function createComponentNewTrademarkForm(): NewTrademarkFormControl
    {
        $control = $this->newTrademarkFormFactory->create();
        $control->onSave[] = function (NewTrademarkFormData $data): void
        {
            try {
                $this->trademarkService->createIfNotExist($data);
                $this->flashMessage('Značka byla přidána.');
                $this->redirect('index');
            } catch (TrademarkAlreadyExistException $exception) {
                $this->flashMessage('Značka s daným názvem již existuje.');
                return;
            }
        };

        return $control;
    }

    protected function createComponentEditTrademarkForm(): EditTrademarkFormControl
    {
        $formData = new EditTrademarkFormData($this->trademark->getName());
        $control = $this->editTrademarkFormFactory->create($formData);
        $control->onSave[] = function (EditTrademarkFormData $data): void
        {
            try {
                $this->trademarkService->updateIfNotExist($data, $this->trademark);
                $this->flashMessage('Editováno.');
                $this->redirect('this');
            } catch (TrademarkAlreadyExistException $exception) {
                $this->flashMessage('Značka s daným názvem již existuje.');
                return;
            }
        };

        return $control;
    }

    public function actionIndex(int $page = 1, bool $desc = false, int $itemPerPage = self::ITEM_PER_PAGE_STEP)
    {
        $trademarksCount = $this->trademarkService->getAllCount();
        $paginator = $this->paginatorFactory->create($trademarksCount, $itemPerPage, $page);
        $trademarks = $this->trademarkService->getAllOrderByName($paginator->getLength(), $paginator->getOffset(), $desc);

        $this->template->itemPerPage = $itemPerPage;
        $this->template->trademarksCount = $trademarksCount;
        $this->template->trademarks = $trademarks;
        $this->template->paginator = $paginator;
        $this->template->desc = $desc;
    }

    public function actionNew(): void
    {
    }

    public function actionDelete(int $id): void
    {
        $this->trademark = $this->trademarkService->findOneById($id);
    }

    public function renderDelete(): void
    {
        $this->template->trademark = $this->trademark;
    }

    public function actionEdit(int $id): void
    {
        $this->trademark = $this->trademarkService->findOneById($id);
    }
}
