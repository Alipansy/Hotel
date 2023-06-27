<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('titre'),
            TextEditorField::new('description_courte'),
            TextEditorField::new('description_longue'),
            ImageField::new('photo')->setBasePath('photo')->setUploadDir('public/photos')->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            NumberField::new('prix'),
            DateTimeField::new('date_enregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),


        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $chambre = new $entityFqcn; 
        $chambre->setDateEnregistrement(new DateTime);
        return $chambre; 
    }
    
    
}
