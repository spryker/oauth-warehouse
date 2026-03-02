<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\OauthWarehouse\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\OauthWarehouse\Business\Checker\WarehouseTokenAuthorizationChecker;
use Spryker\Zed\OauthWarehouse\Business\Checker\WarehouseTokenAuthorizationCheckerInterface;
use Spryker\Zed\OauthWarehouse\Business\Installer\OauthScopeInstaller;
use Spryker\Zed\OauthWarehouse\Business\Installer\OauthScopeInstallerInterface;
use Spryker\Zed\OauthWarehouse\Business\Provider\ScopeProvider;
use Spryker\Zed\OauthWarehouse\Business\Provider\ScopeProviderInterface;
use Spryker\Zed\OauthWarehouse\Business\Provider\WarehouseUserProvider;
use Spryker\Zed\OauthWarehouse\Business\Provider\WarehouseUserProviderInterface;
use Spryker\Zed\OauthWarehouse\Business\Reader\StockReader;
use Spryker\Zed\OauthWarehouse\Business\Reader\StockReaderInterface;
use Spryker\Zed\OauthWarehouse\Dependency\Facade\OauthWarehouseToOauthFacadeInterface;
use Spryker\Zed\OauthWarehouse\Dependency\Facade\OauthWarehouseToStockFacadeInterface;
use Spryker\Zed\OauthWarehouse\Dependency\Service\OauthWarehouseToUtilEncodingServiceInterface;
use Spryker\Zed\OauthWarehouse\OauthWarehouseDependencyProvider;

/**
 * @method \Spryker\Zed\OauthWarehouse\OauthWarehouseConfig getConfig()
 */
class OauthWarehouseBusinessFactory extends AbstractBusinessFactory
{
    public function getOauthFacade(): OauthWarehouseToOauthFacadeInterface
    {
        return $this->getProvidedDependency(OauthWarehouseDependencyProvider::FACADE_OAUTH);
    }

    public function createScopeProvider(): ScopeProviderInterface
    {
        return new ScopeProvider(
            $this->getConfig(),
        );
    }

    public function createOauthScopeInstaller(): OauthScopeInstallerInterface
    {
        return new OauthScopeInstaller(
            $this->getOauthFacade(),
            $this->getConfig(),
        );
    }

    public function createWarehouseTokenAuthorizationChecker(): WarehouseTokenAuthorizationCheckerInterface
    {
        return new WarehouseTokenAuthorizationChecker(
            $this->createStockReader(),
            $this->getConfig(),
        );
    }

    public function createWarehouseUserProvider(): WarehouseUserProviderInterface
    {
        return new WarehouseUserProvider(
            $this->createStockReader(),
            $this->getUtilEncodingService(),
        );
    }

    public function createStockReader(): StockReaderInterface
    {
        return new StockReader($this->getStockFacade());
    }

    public function getStockFacade(): OauthWarehouseToStockFacadeInterface
    {
        return $this->getProvidedDependency(OauthWarehouseDependencyProvider::FACADE_STOCK);
    }

    public function getUtilEncodingService(): OauthWarehouseToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(OauthWarehouseDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
