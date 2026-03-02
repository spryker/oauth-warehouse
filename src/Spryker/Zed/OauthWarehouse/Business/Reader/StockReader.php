<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\OauthWarehouse\Business\Reader;

use Generated\Shared\Transfer\StockCriteriaFilterTransfer;
use Spryker\Zed\OauthWarehouse\Dependency\Facade\OauthWarehouseToStockFacadeInterface;

class StockReader implements StockReaderInterface
{
    /**
     * @var \Spryker\Zed\OauthWarehouse\Dependency\Facade\OauthWarehouseToStockFacadeInterface
     */
    protected OauthWarehouseToStockFacadeInterface $stockFacade;

    public function __construct(OauthWarehouseToStockFacadeInterface $stockFacade)
    {
        $this->stockFacade = $stockFacade;
    }

    public function hasStock(StockCriteriaFilterTransfer $stockCriteriaFilterTransfer): bool
    {
        $stockCollectionTransfer = $this->stockFacade->getStocksByStockCriteriaFilter($stockCriteriaFilterTransfer);
        /** @var \ArrayObject<int, \Generated\Shared\Transfer\StockTransfer> $stockTransfers */
        $stockTransfers = $stockCollectionTransfer->getStocks();

        return $stockTransfers->count() > 0;
    }
}
