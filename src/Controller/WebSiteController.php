<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Website;
use App\Entity\Thematic;
use Psr\Log\LoggerInterface;
use App\Service\MessageGenerator;
use App\Service\SiteUpdateManager;


class WebSiteController extends AbstractController
{
    /**
     * @Route("/website", name="web_site")
     */
    public function index()
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        $website_repository = $em->getRepository(Website::class);
        $thematic_repository = $em->getRepository(Thematic::class);

        $website = $website_repository->findOneByName("TVcongo");
        
        try {
            $em->remove($website);
            //  $em->flush();
        } catch (\Throwable $th) {
        }


        
        // Création de l'entité Advert
        $advert = new Website();
        $advert->setName('TVcongo');
        $advert->setUrl('TVcongo.com');
        $advert->setDescription("Site d'actualité");

        // Création de l'entité Image
        //$image = new Image();
        //$image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
        //$image->setAlt('Job de rêve');

        // On lie l'image à l'annonce
        //$advert->setImage($image);

        // Étape 1 : On « persiste » l'entité
        $em->persist($advert);

        // Étape 1 bis : si on n'avait pas défini le cascade={"persist"},
        // on devrait persister à la main l'entité $image
        // $em->persist($image);

        // Étape 2 : On déclenche l'enregistrement
        //$em->flush();

        //$website_repository->updateUrl("TVcongo", "http://zenga-mambu.com/");

        $advert->setUrl("http://google.com/");
        
        //$em->flush();
        
        return $this->render('web_site/index.html.twig', [
            'controller_name' => 'WebSiteController',
            'thematic' => $thematic_repository->findOneById(3)
        ]);
    }

    /**
     * @Route("debug/{max}")
     */
    public function debug($max, LoggerInterface $logger)
    {
        $logger->info('Look! I just used a service');
        
        return new Response(
            '<html><body>Lucky number: '.$max.'</body></html>'
        );

        // ...
    }

    /**
     * @Route("/message", name="happy")
     */
    public function new(MessageGenerator $messageGenerator, SiteUpdateManager $siteUpdateManager)
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        $mail = $siteUpdateManager->notifyOfSiteUpdate();
        $message = $messageGenerator->getHappyMessage();
        $this->addflash('succes', $message);

        return new Response(
            '<html><body>Lucky number:' .$mail. '</body></html>'
        );

        //...
    }
}
