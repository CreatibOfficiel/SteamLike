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

class EditProfileController extends AbstractController
{
    /**
     * @Route("/edit-profile", name="user_edit_profile")
     */
    public function __invoke(Request $request,
                             UserPasswordEncoderInterface $userPasswordEncoder,
                             EntityManagerInterface $entityManager)
    {
        /** @var User $user */
        $user = $this->getUser();
        $userForm = $this->createForm(UserType::class, $user, [
            'passwordNullable' => true
        ]);

        $userForm->handleRequest($request);
        if($userForm->isSubmitted() && $userForm->isValid()) {
            if(!is_null($user->getPlainPassword())) {
                $user->setPassword($userPasswordEncoder->encodePassword($user, $user->getPlainPassword()));
            }

            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('user/edit-profile.html.twig', [
            'userForm' => $userForm->createView()
        ]);
    }
}