<?php
namespace ZandooBundle\security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use ZandooBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\RequestStack;

final class UtilisateurProvider implements UserProviderInterface
{
    private $em;
    protected $requestStack;
    
    public function __construct(EntityManager $em,RequestStack $requestStack){
        $this->em = $em;    
        $this->requestStack = $requestStack;
    }
    public function supportsClass($class)
    {
        return $class === Utilisateur::class;
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function loadUserByUsername($username)
    {   
        $password =  $this->requestStack->getCurrentRequest()->request->get("_password");
        $utilisateur = $this->em->getRepository(Utilisateur::class)->findOneBy(array('username'=>$username));
        if (is_null($utilisateur)) {
            throw new AccessDeniedHttpException(sprintf('cet utilisateur " %s " n\'existe pas.', $username));
        } 
        if($password != $utilisateur->getPassword()){
           throw new AccessDeniedHttpException('mot de passe incorrect'); 
        }
        $roles = array();  
        if (!$utilisateur->getIsAdmin()) {
            $utilisateur->setRoles("ROLE_ADMIN");
        }   
        return $utilisateur;
    }
}

