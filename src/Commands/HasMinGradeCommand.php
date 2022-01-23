<?php

namespace AdrianMejias\SslLabs\Commands;

use AdrianMejias\SslLabs\SslLabsFacade;
use Illuminate\Console\Command;

/**
 * SSL Labs Has Min Grade Command
 *
 * @package AdrianMejias\SslLabs
 */
class HasMinGradeCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected $signature = 'ssllabs:has-min-grade
            {host? : The hostname}
            {grade? : The ssllabs grade level (A+|A-|A|B|C|D|E|F|T|M)}';

    /**
     * @inheritDoc
     */
    protected $description = 'Check if the host has a minimum grade level';

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

        if ($hasMinGrade === 'yes') {
            $this->info(
                'The host, ' . $host . ', has a minimum grade level of ' . $minGrade . '.'
            );

            return 1;
        }

        $this->error(
            'The host, ' . $host . ', does not have a minimum grade level of ' . $minGrade . '.'
        );

        return 0;
    }
}
