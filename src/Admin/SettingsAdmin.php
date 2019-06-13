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
    const COLUMN_ENABLED        = 'enabled';
    const COLUMN_LIMIT_PAGE     = 'limit_page';
    const ATTR_LABEL            = 'label';
    const LIB_ENABLED           = 'Actif';
    const LIB_WEBSITE           = 'Site web';
    const LIB_PAGINATION        = 'Pagination';

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
                self::ATTR_LABEL => self::LIB_WEBSITE
            ))
            ->add(self::COLUMN_ENABLED, TextType::class, [
                self::ATTR_LABEL => self::LIB_ENABLED
            ])
            ->add(self::COLUMN_LIMIT_PAGE, TextType::class, [
                self::ATTR_LABEL => self::LIB_PAGINATION
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add(self::COLUMN_ENABLED, null, [self::ATTR_LABEL => self::LIB_ENABLED]);
        $datagridMapper->add(self::COLUMN_LIMIT_PAGE, null, [self::ATTR_LABEL => self::LIB_PAGINATION]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier(self::COLUMN_ENABLED, null, [self::ATTR_LABEL => self::LIB_ENABLED]);
        $listMapper->addIdentifier(self::COLUMN_LIMIT_PAGE, null, [self::ATTR_LABEL => self::LIB_PAGINATION]);
        $listMapper->addIdentifier('createdAt', null, [self::ATTR_LABEL => 'Date création', 'header_style' => 'width: 10% !important']);
        $listMapper->addIdentifier('updatedAt', null, [self::ATTR_LABEL => 'Date modification', 'header_style' => 'width: 15% !important']);
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
