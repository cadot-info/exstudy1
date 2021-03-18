<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $pfaker = Factory::create();
        $user = new User();
        $user->setEmail('test@test.fr');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setImage("https://picsum.photos/id/" . rand(100, 200) . "/600/400");
            $article->setVisible(1);
            $article->setAuteur($faker->userName);
            $article->setContenu($faker->realText(random_int(100, 200)));
            $article->setTitre($faker->text(random_int(20, 30)));
            $article->setCreatedAt($faker->dateTime());
            $manager->persist($article);
        }
        $manager->flush();
    }
}
