<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Website;
use App\Entity\Thematic;
use App\Service\SiteUpdateManager;
use Psr\Log\LoggerInterface;

class WebSiteController extends AbstractController
{
    /**
     * @Route("/website", name="web_site")
     */
    public function index()
    {
        // On récupère l'EntityManager
        $em                  = $this->getDoctrine()->getManager();
        $website_repository  = $em->getRepository(Website::class);
        $thematic_repository = $em->getRepository(Thematic::class);

        $website = $website_repository->findOneByName('TVcongo');

        try {
            $em->remove($website);
           
        } catch (\Throwable $th) { }

        // Création de l'entité Advert
        $advert = new Website();
        $advert->setName('TVcongo');
        $advert->setUrl('TVcongo.com');
        $advert->setDescription("Site d'actualité");

        // Étape 1 : On « persiste » l'entité
        $em->persist($advert);

       

        $advert->setUrl('http://google.com/');

        
        return $this->render('web_site/index.html.twig', [
            'controller_name' => 'WebSiteController',
            'thematic'        => $thematic_repository->findOneById(3),
        ]);
    }

    /**
     * @Route("/debug", name="debug")
     */
    public function debug(SiteUpdateManager $messageGenerator, LoggerInterface $logger)
    {
        $messageGenerator->notifyOfSiteUpdate();

        $logger->info('I just got the logger');
        $logger->error('An error occurred');

        $logger->critical('I left the oven on!', [
            // include extra "context" info in your logs
            'cause' => 'in_hurry',
        ]);

        return new Response(
            '<html><body>debug mailer & logger</body></html>'
        );
    }
}
