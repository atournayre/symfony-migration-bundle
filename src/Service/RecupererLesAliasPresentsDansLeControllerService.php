<?php

namespace Atournayre\Bundle\SymfonyMigrationBundle\Service;

class RecupererLesAliasPresentsDansLeControllerService
{
    /**
     * @param string $cheminDuFichier
     *
     * @return array
     */
    public function __invoke(string $cheminDuFichier): array
    {
        $contenuDuFichier = file_get_contents($cheminDuFichier);
        $lignesDuFichier = explode(PHP_EOL, $contenuDuFichier);

        $aliasPattern = '/\$this->(container->|)get\(\'(?<alias>.*)\'\)(;|->)/m';

        return array_unique(
            array_filter(
                array_map(
                    function ($ligne) use ($aliasPattern) {
                        preg_match_all($aliasPattern, $ligne, $matches, PREG_SET_ORDER);
                        if (!array_key_exists(0, $matches)) {
                            return;
                        }
                        if (!array_key_exists('alias', $matches[0])) {
                            return;
                        }
                        return $matches[0]['alias'];
                    },
                    $lignesDuFichier
                )
            )
        );
    }
}