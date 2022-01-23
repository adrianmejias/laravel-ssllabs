<?php

namespace AdrianMejias\SslLabs\Commands;

use AdrianMejias\SslLabs\SslLabsFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

/**
 * SSL Labs Quality Test Command
 *
 * @package AdrianMejias\SslLabs
 */
class QualityTestCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected $signature = 'ssllabs:quality-test
            {host : The hostname}
            {grade? : The ssllabs minimum grade level (A+|A-|A|B|C|D|E|F|T|M}';

    /**
     * @inheritDoc
     */
    protected $description = 'Get SSL Labs quality test results';

    /**
     * @inheritDoc
     */
    public function handle(): ?int
    {
        /** @var string */
        $host = $this->argument('host') ?? '';

        /** @var string */
        $minGrade = $this->argument('grade') ?? 'A+';

        $hasMinGrade = SslLabsFacade::hasMinGrade($host, $minGrade);
        $response = SslLabsFacade::analyze(
            $host,
            null,
            false,
            false,
            false,
            'on',
            true
        );
        $endpointCount = count($response['endpoints'] ?? []);

        $this->info('Host: ' . $host);

        $this->info('Minimum Grade: ' . $minGrade);

        $this->info('Endpoints: ' . $endpointCount);

        $rows = (new Collection($response['endpoints']))->map(
            function ($value) use ($host) {
                $grade = strtoupper($value['grade'] ?? '');
                $ipAddress = $value['ipAddress'] ?? '';
                $detailedUrl = 'https://www.ssllabs.com/ssltest/analyze.html?d=' . $host . '&s=' . $ipAddress;

                return [
                    $grade,
                    $ipAddress,
                    $detailedUrl,
                ];
            }
        )->toArray();

        if ($hasMinGrade === true) {
            $this->table([
                'Grade',
                'IP Address',
                'Detailed Report',
            ], $rows);

            return 1;
        }

        $this->error('Your SSL certificate is not the grading you expected.');

        $this->table([
            'Grade',
            'IP Address',
            'Detailed Report',
        ], $rows);

        return 0;
    }
}
