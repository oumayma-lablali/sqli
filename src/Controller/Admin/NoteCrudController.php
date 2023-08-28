<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NoteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Note::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('note'),
            TextField::new('observation'),
            AssociationField::new('module')
                ->setFormTypeOption('choice_label', 'nom')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('etudiant')
                ->setFormTypeOption('choice_label', function ($etudiant) {
                    return $etudiant->getNom() . ' ' . $etudiant->getPrenom();
                })
                ->setFormTypeOption('by_reference', false),

        ];
    }}
