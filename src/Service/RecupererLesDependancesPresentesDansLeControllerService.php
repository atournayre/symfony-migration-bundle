<?php

namespace Atournayre\Bundle\SymfonyMigrationBundle\Service;

use Symfony\Component\Yaml\Yaml;

class RecupererLesDependancesPresentesDansLeControllerService
{
    private RecupererLesAliasPresentsDansLeControllerService $recupererLesAliasPresentsDansLeControllerService;

    /**
     * @param RecupererLesAliasPresentsDansLeControllerService $recupererLesAliasPresentsDansLeControllerService
     */
    public function __construct(RecupererLesAliasPresentsDansLeControllerService $recupererLesAliasPresentsDansLeControllerService)
    {
        $this->recupererLesAliasPresentsDansLeControllerService = $recupererLesAliasPresentsDansLeControllerService;
    }

    /**
     * @param string $cheminDuFichierController
     * @param array  $fichiersYaml
     *
     * @return array
     */
    public function __invoke(string $cheminDuFichierController, array $fichiersYaml): array
    {
        $services = [];
        foreach ($fichiersYaml as $fichierYaml) {
            $yamlParse = Yaml::parse(file_get_contents($fichierYaml));
            if (!array_key_exists('services', $yamlParse)) {
                continue;
            }
            $services = array_merge($services, $yamlParse['services']);
        }

        $aliases = ($this->recupererLesAliasPresentsDansLeControllerService)($cheminDuFichierController);

        $dependances = [];
        foreach ($aliases as $alias) {
            if (is_null($services[$alias]['class'] ?? null)) {
                continue;
            }
            $dependances[$alias] = $services[$alias]['class'];
        }

        return $dependances;
    }
}