<?php

namespace App\Command;

use App\Entity\Commune;
use App\Entity\Departement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:import-communes', description: 'Importe départements et communes depuis geo.api.gouv.fr')]
class ImportCommunesCommand extends Command
{
    public function __construct(
        private HttpClientInterface $http,
        private EntityManagerInterface $em,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // ---------- 1. Départements ----------
        $byCode = [];
        $byLibelle = [];
        foreach ($this->em->getRepository(Departement::class)->findAll() as $d) {
            if ($d->getCode()) {
                $byCode[$d->getCode()] = $d;
            }
            $byLibelle[mb_strtolower((string) $d->getLibelle())] = $d;
        }

        $rows = $this->http->request('GET', 'https://geo.api.gouv.fr/departements')->toArray();
        foreach ($rows as $row) {
            $dep = $byCode[$row['code']]
                ?? $byLibelle[mb_strtolower($row['nom'])]   // département déjà présent sans code
                ?? new Departement();

            $dep->setCode($row['code']);
            $dep->setLibelle($row['nom']);
            $this->em->persist($dep);
            $byCode[$row['code']] = $dep;
        }
        $this->em->flush();
        $io->success(count($rows).' départements traités.');

        // ---------- 2. Communes ----------
        $byInsee = [];
        $byNomDep = [];
        foreach ($this->em->getRepository(Commune::class)->findAll() as $c) {
            if ($c->getCodeInsee()) {
                $byInsee[$c->getCodeInsee()] = $c;
            } else {
                $key = mb_strtolower((string) $c->getNom()).'|'.($c->getDepartement()?->getId() ?? '');
                $byNomDep[$key] = $c;   // commune déjà présente sans code INSEE
            }
        }

        $rows = $this->http->request(
            'GET',
            'https://geo.api.gouv.fr/communes?fields=nom,code,codeDepartement&format=json',
        )->toArray();

        $i = 0;
        foreach ($rows as $row) {
            $dep = $byCode[$row['codeDepartement'] ?? ''] ?? null;

            $commune = $byInsee[$row['code']] ?? null;
            if (!$commune) {
                $key = mb_strtolower($row['nom']).'|'.($dep?->getId() ?? '');
                $commune = $byNomDep[$key] ?? new Commune();
            }

            $commune->setCodeInsee($row['code']);
            $commune->setNom($row['nom']);
            $commune->setDepartement($dep);
            $this->em->persist($commune);

            if (++$i % 500 === 0) {
                $this->em->flush();
            }
        }
        $this->em->flush();

        $io->success($i.' communes traitées.');

        return Command::SUCCESS;
    }
}