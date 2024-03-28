<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Figure;
use App\Entity\Media;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Fixture Users
        $user1 = new User();
        $user1->setEmail('user1@snowtricks.com');
        $user1->setPassword('0001');
        $user1->setCreatedAt(new \DateTimeImmutable());
        $user1->setFirstname('user1');
        $user1->setLastname('user1');
        $user1->setPicturePath('user1');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('user2@snowtricks.com');
        $user2->setPassword('0002');
        $user2->setCreatedAt(new \DateTimeImmutable());
        $user2->setFirstname('user2');
        $user2->setLastname('user2');
        $user2->setPicturePath('user2');
        $manager->persist($user2);


        $user3 = new User();
        $user3->setEmail('user3@snowtricks.com');
        $user3->setPassword('0003');
        $user3->setCreatedAt(new \DateTimeImmutable());
        $user3->setFirstname('user3');
        $user3->setLastname('user3');
        $user3->setPicturePath('user3');
        $manager->persist($user3);

        //Fixtures Medias
        $media1 = new Media();
        $media1->setPath('media1.webp');
        $media1->setDescription('media1');
        $media1->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('media2.webp');
        $media2->setDescription('media2');
        $media2->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('media3.webp');
        $media3->setDescription('media3');
        $media3->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setPath('media4.webp');
        $media4->setDescription('media4');
        $media4->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setPath('media5.webp');
        $media5->setDescription('media5');
        $media5->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($media5);

        //Fixtures Figures
        $figure1 = new Figure();
        $figure1->setName('figure1');
        $figure1->setContent('Content1');
        $figure1->setCategory('catégorie1');
        $figure1->setCreatedAt(new \DateTimeImmutable());
        $figure1->setUser($user1);
        $manager->persist($figure1);

        $figure2 = new Figure();
        $figure2->setName('figure2');
        $figure2->setContent('Content2');
        $figure2->setCategory('catégorie2');
        $figure2->setCreatedAt(new \DateTimeImmutable());
        $figure2->setUser($user2);
        $manager->persist($figure2);

        $figure3 = new Figure();
        $figure3->setName('figure3');
        $figure3->setContent('Content3');
        $figure3->setCategory('catégorie3');
        $figure3->setCreatedAt(new \DateTimeImmutable());
        $figure3->setUser($user3);
        $manager->persist($figure3);

        $figure4 = new Figure();
        $figure4->setName('figure4');
        $figure4->setContent('Content4');
        $figure4->setCategory('catégorie4');
        $figure4->setCreatedAt(new \DateTimeImmutable());
        $figure4->setUser($user1);
        $manager->persist($figure4);

        $figure5 = new Figure();
        $figure5->setName('figure5');
        $figure5->setContent('Content5');
        $figure5->setCategory('catégorie5');
        $figure5->setCreatedAt(new \DateTimeImmutable());
        $figure5->setUser($user2);
        $manager->persist($figure5);

        $figure6 = new Figure();
        $figure6->setName('figure6');
        $figure6->setContent('Content6');
        $figure6->setCategory('catégorie6');
        $figure6->setCreatedAt(new \DateTimeImmutable());
        $figure6->setUser($user3);
        $manager->persist($figure6);

        $figure7 = new Figure();
        $figure7->setName('figure7');
        $figure7->setContent('Content7');
        $figure7->setCategory('catégorie7');
        $figure7->setCreatedAt(new \DateTimeImmutable());
        $figure7->setUser($user1);
        $manager->persist($figure7);

        $figure8 = new Figure();
        $figure8->setName('figure8');
        $figure8->setContent('Content8');
        $figure8->setCategory('catégorie8');
        $figure8->setCreatedAt(new \DateTimeImmutable());
        $figure8->setUser($user2);
        $manager->persist($figure8);

        $figure9 = new Figure();
        $figure9->setName('figure9');
        $figure9->setContent('Content9');
        $figure9->setCategory('catégorie9');
        $figure9->setCreatedAt(new \DateTimeImmutable());
        $figure9->setUser($user3);
        $manager->persist($figure9);

        $figure10 = new Figure();
        $figure10->setName('figure10');
        $figure10->setContent('Content10');
        $figure10->setCategory('catégorie10');
        $figure10->setCreatedAt(new \DateTimeImmutable());
        $figure10->setUser($user1);
        $manager->persist($figure10);

        //Fixtures comments
        for ($i = 0; $i > 10; $i++){
            $comment1 = new Comment();
            $comment1->setComment('Belle figure '.$i);
            $comment1->setCreatedAt(new \DateTimeImmutable());
            $comment1->setFigure($figure1);
            $manager->persist($comment1);
        }

        for ($i = 0; $i > 10; $i++){
            $comment2 = new Comment();
            $comment2->setComment('good picture '.$i);
            $comment2->setCreatedAt(new \DateTimeImmutable());
            $comment2->setFigure($figure2);
            $manager->persist($comment2);
        }

        $manager->flush();
    }
}
