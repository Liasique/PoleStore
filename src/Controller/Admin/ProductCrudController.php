<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            SlugField::new('slug', 'Slug')->setTargetFieldName('name'),
            ImageField::new('illustration', 'Image')
            // ->setTargetFieldName(['jpg', 'jpeg', 'png'])
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extention]')
            ->setRequired(false),
            TextField::new('subtitle', 'Sous-titre'),
            AssociationField::new('category', 'Categorie'),
            BooleanField::new('isBest', 'Produit à la lune'),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            TextEditorField::new('description', 'Description'),
        ];
    }
   
}
