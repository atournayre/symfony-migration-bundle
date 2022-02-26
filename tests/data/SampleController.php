<?php

namespace Atournayre\Bundle\MakerBundle\Tests;

use DependancePrincipaleService;
use DependanceSecondaireService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SampleController extends Controller
{
    /**
     * @var DependancePrincipaleService
     */
    private $dependancePrincipaleService;
    /**
     * @var DependanceSecondaireService
     */
    private $dependanceSecondaireService;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->dependancePrincipaleService = $this->get('appbundle.dependance_principale.service');
        $this->dependanceSecondaireService = $this->get('appbundle.dependance_secondaire.service');
    }

    /**
     * @param Request $request
     * @param string  $parametre
     *
     * @return Response
     */
    public function __invoke(Request $request, string $parametre): Response
    {
        $dependanceInterne = $this->get('app.dependance_interne');
        $autreDependanceInterne = $this->get('app.autre_dependance_interne');

        $code = 1 + 3;

        return $this->render(
            'index.html.twig',
            [
                'parametre' => $parametre,
            ]
        );
    }

    /**
     * @param Request                               $request
     * @param string                                $parametre
     * @param CreerUneOperationDiverseClientService $creerUneOperationDiverseClientService
     *
     * @return Response
     */
    public function mainAction(Request $request, string $parametre, CreerUneOperationDiverseClientService $creerUneOperationDiverseClientService): Response
    {
        $doublonDevisFamillesOuvragesRepository = $this->get('app.troisieme_dependance');

        $code = 1 + 3;

        return $this->render(
            'index.html.twig',
            [
                'parametre' => $parametre,
            ]
        );
    }

    public function otherAction(Request $request, string $parametre): Response
    {
        $doublonDevisFamillesOuvragesRepository = $this->get('app.troisieme_dependance');

        $code = 1 + 3;

        return $this->render(
            'index.html.twig',
            [
                'parametre' => $parametre,
            ]
        );
    }

    public function oldAction(Request $request, $parametre)
    {
        $doublonDevisFamillesOuvragesRepository = $this->get('app.troisieme_dependance');

        $code = 1 + 3;

        return $this->render(
            'index.html.twig',
            [
                'parametre' => $parametre,
            ]
        );
    }
}
