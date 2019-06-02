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
        $formMapper->add('name', EntityType::class, array(
                       'class' => 'App\Entity\Keywords',
                       'choice_label' => function ($keywords) {
                           $list = $keywords->getList();
                           return "{$list}";
                       }
        ));
        $formMapper->add('description', TextType::class, [
                        'label' => 'Description'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('createdAt', null, array('label' => 'Date création', 'header_style' => 'width: 10% !important'));
        $listMapper->addIdentifier('updatedAt', null, array('label' => 'Date modification', 'header_style' => 'width: 10% !important'));
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
