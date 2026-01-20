<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $admin = new User();
        $admin->setEmail('admin@otakool.com')
            ->setUsername('GrandArchitecte')
            ->setRoles(['ROLE_ADMIN'])
            ->setBio('Je suis le créateur de ce monde. Inclinez-vous, mortels.')
            ->setXp(999999)
            ->setLevel(100)

            ->setPreferences([
                'locale' => 'fr',
                'sound_enabled' => true,
                'theme' => 'dark'
            ])
            ->setIsPremium(true)
            ->setPremiumEndAt(new DateTime('+10 years'));

        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $manager->persist($admin);
        $this->addReference('USER_ADMIN', $admin);

        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $email = $faker->unique()->email();
            $username = $faker->unique()->userName();

            $xp = $faker->numberBetween(0, 150000);
            $level = $this->calculateLevelFromXp($xp);

            // Pour l'instant le titre n'est pas stocké en dur si on le calcule dynamiquement,
            // mais si tu as un champ 'title' ou 'rankName' en base, on pourrait le setter ici.
            // Supposons qu'on le gère à l'affichage via le Level.

            $user->setEmail($email)
                ->setUsername($username)
                ->setRoles(['ROLE_USER'])
                ->setBio($faker->realText(100))
                ->setXp($xp)
                ->setLevel($level)
                ->setPreferences([
                    'locale' => $faker->randomElement(['fr', 'en']), // Certains parlent anglais
                    'sound_enabled' => $faker->boolean(80), // 80% des gens aiment le son
                    'theme' => 'auto'
                ]);

            // Gestion Premium
            if ($faker->boolean(10)) { // 10% de VIP
                $user->setIsPremium(true);
                $user->setPremiumEndAt($faker->dateTimeBetween('+1 month', '+1 year'));
            }

            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $manager->persist($user);
            $this->addReference('USER_' . $i, $user);
        }

        $manager->flush();
    }

    /**
     * Petite logique métier simulée pour la cohérence des fixtures
     */
    private function calculateLevelFromXp(int $xp): int
    {
        // Formule simplifiée : Racine carrée de l'XP ou paliers fixes
        // Ici, on fait simple pour l'exemple
        if ($xp < 100) return 1;    // PNJ
        if ($xp < 500) return 5;    // KOHAI
        if ($xp < 2000) return 10;  // GENIN
        if ($xp < 10000) return 30; // AVENTURIER
        if ($xp < 50000) return 60; // CORSAIRE
        if ($xp < 100000) return 80;// YONKO
        return 100;          // DIVINITÉ
    }
}
