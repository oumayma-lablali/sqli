<?php

namespace App\Controller\Admin;

use App\Entity\Module;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ModuleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Module::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            AssociationField::new('enseignant')
                ->setFormTypeOption('choice_label', 'nom')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('filier')
                ->setFormTypeOption('choice_label', 'nom')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('semestre')
                ->setFormTypeOption('choice_label', 'nom')
                ->setFormTypeOption('by_reference', false),

        ];
    }

}
