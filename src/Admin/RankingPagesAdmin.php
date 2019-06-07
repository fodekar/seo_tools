<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class RankingPagesAdmin extends AbstractAdmin
{
    const COLUMN_NUMBER_PAGE       = 'number_page';
    const COLUMN_POSITION          = 'position';
    const COLUMN_POSITION_PREVIOUS = 'position_previous';

    /**
     * Default Datagrid values.
     *
     * @var array
     */
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by'    => 'createdAt',
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('searchengine', EntityType::class, [
            'class'        => 'App\Entity\SearchEngine',
            'choice_label' => function ($searchEngine) {
                $name = $searchEngine->getName();

                return "{$name}";
            },
            'label' => 'Moteur de recherche',
        ]);
        $formMapper->add('thematic', EntityType::class, [
            'class'        => 'App\Entity\Thematic',
            'choice_label' => function ($thematic) {
                $name = $thematic->getName();

                return "{$name}";
            },
            'label' => 'Thématique',
        ]);
        $formMapper->add(self::COLUMN_POSITION_PREVIOUS, TextType::class, [
            'label' => 'Position précédente',
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add(self::COLUMN_NUMBER_PAGE);
        $datagridMapper->add(self::COLUMN_POSITION);
        $datagridMapper->add(self::COLUMN_POSITION_PREVIOUS);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier(self::COLUMN_NUMBER_PAGE);
        $listMapper->addIdentifier(self::COLUMN_POSITION);
        $listMapper->addIdentifier(self::COLUMN_POSITION_PREVIOUS);
        $listMapper->addIdentifier('createdAt', null, ['label' => 'Date création', 'header_style' => 'width: 10% !important']);
        $listMapper->addIdentifier('updatedAt', null, ['label' => 'Date modification', 'header_style' => 'width: 10% !important']);
    }

    public function toString($object)
    {
        return $object instanceof App\Entity\RankingPages
            ? $object->getName()
            : null;
    }

    public function preUpdate($rankingPages)
    {
        $rankingPages->setUpdatedAt(new \DateTime());
    }
}
