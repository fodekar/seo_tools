<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SearchEngine;

class SearchEngineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = [
            'Google' => [
                'variables' => '?q=[query]&start=[position]'
<<<<<<< HEAD
=======
            ],
            'Yahoo' => [
                'variables' => '?p=[query]&b=[position]'
            ],
            'Bing' => [
                'variables' => '?q=[query]&start=[position]'
>>>>>>> 49e3de886f6d1585a6d562123da76f7f462ffcf5
            ]
        ];

        foreach ($data as $name => $search_engine) {
            $name_unique = $manager->getRepository(SearchEngine::class)->findOneByName($name);

            if (null == $name_unique) {
                $_search_engine = new SearchEngine();
                $_search_engine->setName($name);
                $_search_engine->setVariables($search_engine['variables']);

                $manager->persist($_search_engine);
            }
        }

        $manager->flush();
    }
}
