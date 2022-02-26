<?php

/*
 * This file is part of the Atournayre SymfonyMigrationBundle package.
 *
 * (c) Aurélien Tournayre <aurelien.tournayre@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atournayre\Bundle\SymfonyMigrationBundle;

use Atournayre\Bundle\SymfonyMigrationBundle\DependencyInjection\AtournayreSymfonyMigrationExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Aurélien Tournayre <aurelien.tournayre@gmail.com>
 */
class AtournayreSymfonyMigrationBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new AtournayreSymfonyMigrationExtension();
        }

        return $this->extension;
    }
}
