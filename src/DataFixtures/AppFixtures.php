<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User;
        $user->setEmail("user@user.com");
        $user->setRoles(["ROLE_USER"]);
        $pw = $this->passwordHasher->hashPassword($user, "user");
        $user->setPassword($pw);
        $manager->persist($user);

        $user = new User;
        $user->setEmail("admin@admin.com");
        $user->setRoles(["ROLE_ADMIN"]);
        $pw = $this->passwordHasher->hashPassword($user, "admin");
        $user->setPassword($pw);
        $manager->persist($user);

        $user = new User;
        $user->setEmail("manager@manager.com");
        $user->setRoles(["ROLE_MANAGER"]);
        $pw = $this->passwordHasher->hashPassword($user, "manager");
        $user->setPassword($pw);
        $manager->persist($user);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['tagada'];
    }
}
