<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Website;
use App\Entity\Thematic;


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
            $em->flush();
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
        $em->flush();

        //$website_repository->updateUrl("TVcongo", "http://zenga-mambu.com/");

        $advert->setUrl("http://google.com/");
        
        $em->flush();
        
        return $this->render('web_site/index.html.twig', [
            'controller_name' => 'WebSiteController',
            'thematic' => $thematic_repository->findOneById(3)
        ]);
    }
}
