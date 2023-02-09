<?php

namespace App\Controller;

use Requests;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    private $em;
public function __construct (EntityManagerInterface $em){
    $this->em = $em;
}

    #[Route('/account/password-modify', name: 'account_password')]
    public function index(Request $request, UserPasswordHasherInterface $hasher ): Response
    {
        $notification = null;
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid ()) {
            $old_pwd = $form->get('old_password')->getData();//comparaisin des mot de passe
            if ($hasher->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $hasher->hashPassword($user, $new_pwd);
                $user->setPassword($password);
                $this->em->persist($user);
                $this->em->flush();
                $this->addFlash('success','Votre mot de passe a bien été modifié');
            } else{
$this->addFlash('danger','Votre mot de passe actuelle n\est pas correct');
            }
        } 
        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
