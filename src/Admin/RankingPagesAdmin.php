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
    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt',
    );
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('number_page', EntityType::class, array(
                       'class' => 'App\Entity\SearchEngine',
                       'choice_label' => function ($searchEngine) {
                           $name = $searchEngine->getName();
                           return "{$name}";
                       }
        ));
        $formMapper->add('position', EntityType::class, array(
                       'class' => 'App\Entity\Thematic',
                       'choice_label' => function ($thematic) {
                           $name = $thematic->getName();
                           return "{$name}";
                       },
                       'label' => 'Thematic'
        ));
        $formMapper->add('position_previous', TextType::class, [
                       'label' => 'Position_précédente'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('number_page');
        $datagridMapper->add('position');
        $datagridMapper->add('position_previous');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('number_page');
        $listMapper->addIdentifier('position');
        $listMapper->addIdentifier('position_previous');
        $listMapper->addIdentifier('createdAt', null, array('label' => 'Date création', 'header_style' => 'width: 10% !important'));
        $listMapper->addIdentifier('updatedAt', null, array('label' => 'Date modification', 'header_style' => 'width: 10% !important'));
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
