<?php

namespace Atournayre\Bundle\SymfonyMigrationBundle\Tests;

use Atournayre\Bundle\SymfonyMigrationBundle\Service\RecupererLesAliasPresentsDansLeControllerService;
use Atournayre\Bundle\SymfonyMigrationBundle\Service\RecupererLesDependancesPresentesDansLeControllerService;
use PHPUnit\Framework\TestCase;

class RecupererLesDependancesPresentesDansLeControllerTest extends TestCase
{
    public function testRecupererLesDependancesPresentesDansLeController()
    {
        $cheminDuFichierController = __DIR__ . '/data/SampleController.php';
        $fichiersYaml = [
            __DIR__ . '/data/sample.yml',
        ];

        $recupererLesAliasPresentsDansLeControllerService = new RecupererLesAliasPresentsDansLeControllerService();
        $recupererLesDependancesPresentesDansLeControllerService = new RecupererLesDependancesPresentesDansLeControllerService(
            $recupererLesAliasPresentsDansLeControllerService
        );
        $dependancesPresentesDansLeController = ($recupererLesDependancesPresentesDansLeControllerService)($cheminDuFichierController, $fichiersYaml);

        $arrayAttendu = [
            'appbundle.dependance_principale.service' => 'DependancePrincipaleService',
            'appbundle.dependance_secondaire.service' => 'DependanceSecondaireService',
            'app.dependance_interne' => 'DependanceInterne',
            'app.autre_dependance_interne' => 'AutreDependanceInterne',
            'app.troisieme_dependance' => 'TroisiemeDependance',

        ];
        $this->assertEquals($arrayAttendu, $dependancesPresentesDansLeController);
    }
}