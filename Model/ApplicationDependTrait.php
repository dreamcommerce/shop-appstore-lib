<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Model;

trait ApplicationDependTrait
{
    /**
     * @var string|null
     */
    protected $applicationName;

    /**
     * @var ApplicationInterface|null
     */
    protected $application;

    /**
     * @return string|null
     */
    public function getApplicationName(): ?string
    {
        return $this->applicationName;
    }

    /**
     * @return ApplicationInterface|null
     */
    public function getApplication(): ?ApplicationInterface
    {
        return $this->application;
    }

    /**
     * @param ApplicationInterface|null $application
     */
    public function setApplication(?ApplicationInterface $application): void
    {
        $this->application = $application;
    }
}
