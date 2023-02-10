<?php

namespace App\Controller;

use Requests;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class RegisterController extends AbstractController
{
    private $em;
    public function __construct (EntityManagerInterface $em)
    {
        $this->em =$em;
    }
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $user =new User();
        $form = $this->createForm (RegisterType::class, $user);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            $user= $form->getData();
            $password= $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
            //dd($password);
            $this->em->persist($user);

            $this->em->flush();
        
            // $this->addFlash('success','Vous etes inscrit');
        
            $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ] );
    }
}
