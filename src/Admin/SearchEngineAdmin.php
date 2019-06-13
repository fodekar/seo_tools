<?php

// src/Admin/CategoryAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SearchEngineAdmin extends AbstractAdmin
{
    const COLUMN_NAME           = 'name';
    const COLUMN_VARIABLES      = 'variables';
    const ATTR_LABEL            = 'label';
    const LIB_NAME              = 'Nom';
    const LIB_PARAMS            = 'Paramètres';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add(self::COLUMN_NAME, TextType::class, [
            self::ATTR_LABEL => self::LIB_NAME,
        ]);
        $formMapper->add(self::COLUMN_VARIABLES, TextType::class, [
            self::ATTR_LABEL => self::LIB_PARAMS,
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add(self::COLUMN_NAME, null, [self::ATTR_LABEL => self::LIB_NAME]);
        $datagridMapper->add(self::COLUMN_VARIABLES, null, [self::ATTR_LABEL => self::LIB_PARAMS]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier(self::COLUMN_NAME, null, [self::ATTR_LABEL => self::LIB_NAME]);
        $listMapper->addIdentifier(self::COLUMN_VARIABLES, null, [self::ATTR_LABEL => self::LIB_PARAMS]);
        $listMapper->addIdentifier('createdAt', null, [self::ATTR_LABEL => 'Date création', 'header_style' => 'width: 10% !important']);
        $listMapper->addIdentifier('updatedAt', null, [self::ATTR_LABEL => 'Date modification', 'header_style' => 'width: 15% !important']);
    }
}