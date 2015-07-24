<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Build extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'build';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Build the site for Docker usage';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$tag = $this->argument('tag');
		$env = $this->option('qa') ? 'qa' : 'production';
		$php = $this->option('php') ? 'php' : 'hhvm';

		$this->info('Exporting MySQL Database');
		echo exec('mysqldump -u homestead -psecret ffxivcrafting > ../ffxiv-k8s-clus/caas-db/caas.sql');


		// TODO, add 2>&1

		$this->info('Clearing caches');
		echo exec($php . ' artisan cache:clear') . PHP_EOL;
		echo exec($php . ' artisan route:clear') . PHP_EOL;
		echo exec($php . ' artisan config:clear') . PHP_EOL;
		echo exec($php . ' artisan view:clear') . PHP_EOL;
		echo exec($php . ' artisan inspire') . PHP_EOL;

		$this->info('Switching Environment to ' . strtoupper($env));
		echo exec('cp .env.' . $env . ' .env');

		$this->info('Updating an Optimized/NoDev Composer');
		echo exec('composer update --no-dev -o') . PHP_EOL;

		$this->info('Caching!');
		echo exec($php . ' artisan route:cache') . PHP_EOL;
		echo exec($php . ' artisan config:cache') . PHP_EOL;

		$this->info('Creating Tarball');

		$exclude_from_tar = [
			'caas/.env.*',
			'caas/.git/*',
			'caas/node_modules/*',
			'caas/caas/*',
			'caas/docker/*',
			'caas/resources/assets/*',
			'caas/storage/app/osmose/*',
		];

		exec('tar --exclude="' . implode('" --exclude="', $exclude_from_tar) . '" -zhcvf docker/caas-web.tar.gz caas/') . PHP_EOL;

		$this->reset();

		if ($this->confirm('Ready to Tag and Push? [yes|no]'))
		{
			echo exec('git commit -a -m "' . $tag . ' Release"') . PHP_EOL;
			echo exec('git tag ' . $tag . '') . PHP_EOL;
			$this->info('RUN THIS: git push --tags origin master');
		}

		$this->info('Done!');
	}

	/**
	 * Run commands to reset the instance back to normal
	 */
	public function reset()
	{
		$this->info('Resetting back to normal, clearing caches again');
		echo exec($php . ' artisan route:clear') . PHP_EOL;
		echo exec($php . ' artisan config:clear') . PHP_EOL;
		echo exec($php . ' artisan cache:clear') . PHP_EOL;
		echo exec($php . ' artisan view:clear') . PHP_EOL;

		$this->info('Switching Environment to Local');
		echo exec('cp .env.local  .env') . PHP_EOL;

		$this->info('Updating Composer for Development');
		echo exec('composer update') . PHP_EOL;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['tag', InputArgument::REQUIRED, 'What to tag, like 3.0.1'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['php', null, InputOption::VALUE_NONE, 'Use PHP instead of HHVM', null],
			['qa', null, InputOption::VALUE_NONE, 'Run for a QA build over Production', null],
		];
	}

}
