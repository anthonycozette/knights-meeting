<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Evenement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        // on memorise le UserPasswordHasherInterface injecte dans la propriete de classe de sorte qu'on y aura acces depuis toutes les methodes de classe
        $this->encoder = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager)
    {
        //creation d'un utilisateur
        $user = new User();

        $user->setEmail('admin@admin.com')
            ->setPseudo('cocobico')
            ->setNom('cozette')
            ->setRoles(["ROLE_ADMIN"])
            ->setPrenom('anthony');

        $password = $this->encoder->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();

        // creation de 5 evenement
        $date = new DateTime();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('th.jpg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('image6.jpeg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('th.jpg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('image6.jpeg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('th.jpg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('image6.jpeg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('th.jpg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('image6.jpeg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('th.jpg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();

        $evenement = new Evenement();
        $evenement->setNom('dongeon dragon')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus, nisl vel luctus ultricies, lorem odio fermentum neque, a dignissim quam dui in dolor. Morbi vel nunc dapibus, facilisis nunc eget, accumsan sem. Nullam lobortis lacus nec orci aliquam viverra. Quisque ac lorem facilisis, fermentum mauris vitae, consequat tellus. Ut ultricies, neque nec congue accumsan, enim metus pharetra tortor, sit amet porttitor purus nisi a quam. Nulla eget tincidunt enim. Integer velit ipsum, commodo in odio vel, vulputate fringilla magna. Phasellus ut ultricies felis, ut molestie metus. Vestibulum eget justo ligula. Aliquam pretium eros id congue interdum. Vivamus sed nibh non leo gravida mattis. Pellentesque efficitur quam et massa sollicitudin, placerat viverra leo cursus. Duis egestas ullamcorper lacus, ac viverra augue tempus sed.')
            ->setPrix(60)
            ->setDateDebut($date)
            ->setDateFin($date)
            ->setCreatedAt($date)
            ->setFiles('image6.jpeg')
            ->setVille('chilly')
            ->setCodePostal('91380')
            ->setAdresse(' 4 rue des roses')
            ->setSlug('3')
            ->setUser($user);
        $manager->persist($evenement);
        $manager->flush();
    }
}
