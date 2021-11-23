<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('imageFile')->setFormType(VichImageType::class),
            ImageField::new('files')->setBasePath('/uploads/evenements')->onlyOnIndex(),
            TextField::new('nom'),
            TextareaField::new('description'),
            TextField::new('adresse'),
            NumberField::new('codePostal'),
            TextField::new('ville'),
            NumberField::new('prix'),
            DateField::new('dateDebut'),
            DateField::new('dateFin'),
            DateField::new('createdAt')->HideOnForm(),
            SlugField::new('slug')->setTargetFieldName('nom')->hideOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC']);
    }
}
