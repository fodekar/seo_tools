<?php

// src/Admin/CategoryAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class WebSiteAdmin extends AbstractAdmin
{
    const COLUMN_NAME        = 'name';
    const COLUMN_URL         = 'url';
    const COLUMN_DESCRIPTION = 'description';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add(self::COLUMN_NAME, TextType::class);
        $formMapper->add(self::COLUMN_URL, TextType::class);
        $formMapper->add(self::COLUMN_DESCRIPTION, TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add(self::COLUMN_NAME);
        $datagridMapper->add(self::COLUMN_URL);
        $datagridMapper->add(self::COLUMN_DESCRIPTION);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier(self::COLUMN_NAME);
        $listMapper->addIdentifier(self::COLUMN_URL);
        $listMapper->addIdentifier(self::COLUMN_DESCRIPTION);
    }
}