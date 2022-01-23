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
            {host : The hostname}
            {grade? : The ssllabs minimum grade level (A+|A-|A|B|C|D|E|F|T|M)}';

    /**
     * @inheritDoc
     */
    protected $description = 'Check if the host has a minimum grade level';

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

        if ($hasMinGrade === true) {
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
