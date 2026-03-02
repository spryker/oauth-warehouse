<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\OauthWarehouse\Dependency\Facade;

use Generated\Shared\Transfer\OauthScopeTransfer;

class OauthWarehouseToOauthFacadeBridge implements OauthWarehouseToOauthFacadeInterface
{
    /**
     * @var \Spryker\Zed\Oauth\Business\OauthFacadeInterface
     */
    protected $oauthFacade;

    /**
     * @param \Spryker\Zed\Oauth\Business\OauthFacadeInterface $oauthFacade
     */
    public function __construct($oauthFacade)
    {
        $this->oauthFacade = $oauthFacade;
    }

    public function saveScope(OauthScopeTransfer $oauthScopeTransfer): OauthScopeTransfer
    {
        return $this->oauthFacade->saveScope($oauthScopeTransfer);
    }

    /**
     * @param array<string> $userScopes
     *
     * @return array<\Generated\Shared\Transfer\OauthScopeTransfer>
     */
    public function getScopesByIdentifiers(array $userScopes): array
    {
        return $this->oauthFacade->getScopesByIdentifiers($userScopes);
    }
}
