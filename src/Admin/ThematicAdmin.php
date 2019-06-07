<?php

// src/Admin/CategoryAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class ThematicAdmin extends AbstractAdmin
{
    const COLUMN_NAME              = 'name';
    const COLUMN_DESCRIPTION       = 'description';
    const ATTR_LABEL               = 'label';
    const LIB_NAME                 = 'Nom';
    const LIB_DESCRIPTION          = 'Description';

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
        $formMapper->add('keywords', EntityType::class, array(
            'class' => 'App\Entity\Keywords',
            'choice_label' => function ($keywords) {
                $list = $keywords->getList();
                return "{$list}";
            },
            self::ATTR_LABEL => 'Mot clés'
        ));
        $formMapper->add(self::COLUMN_NAME, TextType::class, [
            self::ATTR_LABEL => 'Nom'
        ]);
        $formMapper->add(self::COLUMN_DESCRIPTION, TextType::class, [
            self::ATTR_LABEL => 'Description'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add(self::COLUMN_NAME);
        $datagridMapper->add(self::COLUMN_DESCRIPTION);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier(self::COLUMN_NAME, null, [self::ATTR_LABEL => self::LIB_NAME]);
        $listMapper->addIdentifier(self::COLUMN_DESCRIPTION, null, [self::ATTR_LABEL => self::LIB_DESCRIPTION]);
        $listMapper->addIdentifier('createdAt', null, [self::ATTR_LABEL => 'Date création', 'header_style' => 'width: 10% !important']);
        $listMapper->addIdentifier('updatedAt', null, [self::ATTR_LABEL => 'Date modification', 'header_style' => 'width: 10% !important']);
    }

    public function toString($object)
    {
        return $object instanceof App\Entity\Thematic
            ? $object->getList()
            : null;
    }

    public function preUpdate($thematic)
    {
        $thematic->setUpdatedAt(new \DateTime());
    }
}
