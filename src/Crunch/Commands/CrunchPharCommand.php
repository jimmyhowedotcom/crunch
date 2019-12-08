<?php namespace Crunch\Commands;

use Crunch\PharCruncher;
use Crunch\Strategies\DefaultStrategy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CrunchPharCommand extends Command
{
	protected static $defaultName = 'phar';

	protected function configure()
	{
		$this->setDescription('Creates a Phar file')->setHelp('This command allows you to create a PHP Archive file.');

		$this->addArgument('from', InputArgument::REQUIRED, 'Who do you want to greet?');
		$this->addArgument('to', InputArgument::REQUIRED, 'Who do you want to greet?');

		$this->addOption('clean', 'c', InputOption::VALUE_OPTIONAL, 'Clean the directory first?', 1);
	}

	/**
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @return int|void|null
	 */
	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$cruncher = new PharCruncher();

		$from = $input->getArgument("from");
		$to   = $input->getArgument("to");

		$cruncher->using(new DefaultStrategy)->crunch($from, $to, "index.php", []);
	}
}
