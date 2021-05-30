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

class ShowProfileController extends AbstractController
{
    /**
     * @Route("/show-profile/{id}", name="user_show_profile")
     */
    public function __invoke(User $user)
    {
        return $this->render('user/show-profile.html.twig', [
            'user' => $user
        ]);
    }
}