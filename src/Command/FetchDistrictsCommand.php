<?php
declare(strict_types=1);

namespace App\Command;

use App\Services\FetchDistrictDataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FetchDistrictsCommand extends Command
{
    protected static $defaultName = 'app:fetch-districts';
    protected static $defaultDescription = 'Fetch districts data';

    private FetchDistrictDataService $service;

    /**
     * @param FetchDistrictDataService $service
     */
    public function __construct(FetchDistrictDataService $service)
    {
        parent::__construct();
        $this->service = $service;
    }


    protected function configure(): void
    {
        $this->setDescription(self::$defaultDescription);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        try {
            $this->service->fetch();
        } catch (\Exception $e) {
            $io->error('fetching error');
            return 1;
        }

        $io->success('success');

        return 0;
    }
}
