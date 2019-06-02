<?php

// src/Admin/CategoryAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class SettingsAdmin extends AbstractAdmin
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
        $formMapper
            ->add('search_engine', EntityType::class, array(
                'class' => 'App\Entity\SearchEngine',
                'choice_label' => function ($searchEngine) {
                    $name = $searchEngine->getName();
                    return "{$name}";
                }
            ))
            ->add('website', EntityType::class, array(
                'class' => 'App\Entity\Website',
                'choice_label' => function ($website) {
                    $name = $website->getName();
                    return "{$name}";
                },
                'label' => 'Site web'
            ))
            ->add('enabled', TextType::class, [
                'label' => 'Actif'
            ])
            ->add('limit_page', TextType::class, [
                'label' => 'Pagination'
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('enabled');
        $datagridMapper->add('limit_page');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('enabled');
        $listMapper->addIdentifier('limit_page');
        $listMapper->addIdentifier('createdAt', null, array('label' => 'Date création', 'header_style' => 'width: 10% !important'));
        $listMapper->addIdentifier('updatedAt', null, array('label' => 'Date modification', 'header_style' => 'width: 10% !important'));
    }

    public function toString($object)
    {
        return $object instanceof App\Entity\Settings
            ? $object->getName()
            : null;
    }

    public function preUpdate($settings)
    {
        $settings->setUpdatedAt(new \DateTime());
    }
}
