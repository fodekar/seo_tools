<?php

// src/Admin/CategoryAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class KeywordsAdmin extends AbstractAdmin
{
    const COLUMN_LIST   = 'list';
    const ATTR_LABEL    = 'label';
    const LIB_LIST      = 'VALEUR';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add(self::COLUMN_LIST, TextType::class, [
            self::ATTR_LABEL => self::LIB_LIST,
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add(self::COLUMN_LIST, null, [self::ATTR_LABEL => self::LIB_LIST]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier(self::COLUMN_LIST, null, [self::ATTR_LABEL => self::LIB_LIST]);
    }
}