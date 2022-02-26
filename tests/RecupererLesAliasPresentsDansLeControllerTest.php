<?php

namespace Atournayre\Bundle\SymfonyMigrationBundle\Tests;

use Atournayre\Bundle\SymfonyMigrationBundle\Service\RecupererLesAliasPresentsDansLeControllerService;
use PHPUnit\Framework\TestCase;

class RecupererLesAliasPresentsDansLeControllerTest extends TestCase
{
    public function testRecupererLesAliasPresentsDansLeController()
    {
        $cheminDuFichierController = __DIR__ . '/data/SampleController.php';
        $recupererLesAliasPresentsDansLeControllerService = new RecupererLesAliasPresentsDansLeControllerService();
        $aliasPresentsDansLeController = ($recupererLesAliasPresentsDansLeControllerService)($cheminDuFichierController
        );

        $arrayAttendu = [
            28 => 'appbundle.dependance_principale.service',
            29 => 'appbundle.dependance_secondaire.service',
            40 => 'app.dependance_interne',
            41 => 'app.autre_dependance_interne',
            62 => 'app.devis.famille_ouvrage.repository',
        ];

        $this->assertEquals($arrayAttendu, $aliasPresentsDansLeController);
    }
}