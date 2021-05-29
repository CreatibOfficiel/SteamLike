<?php


namespace App\Controller\User;

use App\Entity\User;
use App\Form\User\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class CreateAccountController extends AbstractController
{
    /**
     * @Route("/create-account", name="create_account")
     */
    public function __invoke(Request $request,
                             UserPasswordEncoderInterface $userPasswordEncoder,
                             EntityManagerInterface $entityManager)
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);
        if($userForm->isSubmitted() && $userForm->isValid()) {
            $user->setPassword($userPasswordEncoder->encodePassword($user, $user->getPlainPassword()));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/create-account.html.twig', [
            'userForm' => $userForm->createView()
        ]);
    }
}