<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SearchEngine;

class SearchEngineFixtures extends Fixture
{
    const INDEX_VARIABLES = 'variables';

    public function load(ObjectManager $manager)
    {
        $data = [
            'Google' => [
                self::INDEX_VARIABLES => '?q=[query]&start=[position]',
            ],
            'Yahoo' => [
                self::INDEX_VARIABLES => '?p=[query]&b=[position]',
            ],
            'Bing' => [
                self::INDEX_VARIABLES => '?q=[query]&start=[position]',
            ],
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
