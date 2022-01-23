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
            {host? : The hostname}
            {grade? : The ssllabs grade level (A+|A-|A|B|C|D|E|F|T|M}';

    /**
     * @inheritDoc
     */
    protected $description = 'Get SSL Labs quality test results';

    /**
     * @inheritDoc
     */
    public function handle(): ?int
    {
        $host = $this->argument('host') ?? str_replace(
            ['http://', 'https://'],
            '',
            config(
                'app.url',
                'https://www.ssllabs.com'
            )
        );
        $minGrade = $this->argument('grade') ?? config(
            'ssllabs.min_grade',
            'A+'
        );

        $hasMinGrade = SslLabsFacade::hasMinGrade($host, $minGrade) === true
            ? 'yes' : 'no';
        $response = SslLabsFacade::analyze(
            $host,
            null,
            false,
            false,
            false,
            'on',
            true
        );
        $headers = [
            'Grade',
            'IP Address',
            'Detailed Report',
        ];

        $this->info('Host: ' . $host);
        $this->info('Minimum Grade: ' . $minGrade);
        $this->info('Endpoints: ' . count($response['endpoints'] ?? []));

        $rows = (new Collection($response['endpoints']))->map(
            function ($value) use ($host) {
                $grade = strtoupper($value['grade'] ?? '');
                $ipAddress = $value['ipAddress'] ?? '';

                return [
                    $grade,
                    $ipAddress,
                    'https://www.ssllabs.com/ssltest/analyze.html?d=' . $host .
                        '&s=' . $ipAddress,
                ];
            }
        )->toArray();

        if ($hasMinGrade === 'yes') {
            $this->table($headers, $rows);

            return 1;
        }

        $this->error('Your SSL certificate is not the grading you expected.');

        $this->table($headers, $rows);

        return 0;
    }
}
