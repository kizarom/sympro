<?php

namespace App\DataFixtures;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<3;$i++){
         $user = new User();
         $user->setEmail("youssef$i@email.com");
         $user->setRoles(["ROLE_USER"]);
         $user->setPassword($this->passwordEncoder->encodePassword(
                        $user,
                        'youssef'
                    ));
         $manager->persist($user);
        }
        $manager->flush();
    }
}
