<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            
            
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $user = new $entityFqcn; 
        $user->setDateEnregistrement(new DateTime);
        return $user; 
    }
    
    
}
