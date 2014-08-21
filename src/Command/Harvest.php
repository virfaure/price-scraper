<?php

namespace TET\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Harvest extends Command {

    const HARVEST_ALL_KEY = "all";

    protected function configure() {

        $sites =  \Model::factory('TET\Model\Site')
            ->where_not_equal('spider', 'NULL')
            ->where_equal('active', 1)
            ->find_many();

        $sites = array_map(function($site) { return $site->name; }, $sites->as_array());
        $sites[] = self::HARVEST_ALL_KEY;

        $this
            ->setName('tet:harvest')
            ->setDescription('Harvest data from websites')
            ->addArgument('site', InputArgument::REQUIRED, "Site to harvest, available options:\n\t\t* " . join($sites, "\n\t\t* "))
            ->addOption('delay', NULL, InputOption::VALUE_REQUIRED, 'Delay between page fetches (seconds)', 1)
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $site_name = $input->getArgument('site');
        $delay = $input->getOption('delay');

        $sites = \Model::factory('TET\Model\Site')
            ->where_equal('active', 1);
        if ($site_name !== self::HARVEST_ALL_KEY) $sites->where_equal('name', $site_name);

        $count = 0;
        foreach ($sites->find_many() as $site) {

            if ($output->isVerbose()) {
                $output->writeln("<fg=green>Processing site " . $site->name . "</fg=green>");
            }

            $spider = $site->getSpider();
            if (!$spider) {
                $output->writeln("<error>No spider for site " . $site->name . "</error>");
                continue;
            }

            $pages = $site->pages()->order_by_expr('RAND()')->find_many();
            foreach ($pages as $page) {

                try {
                    if ($output->isVerbose()) {
                        $output->writeln("<fg=green>Processing URL " . $page->url . "</fg=green>");
                    }
                    $rows = $spider->parse($page->url);
                } catch (Exception $e) {
                    $output->writeln("<error>Unhandled error in spider " . $site->spider . " when parsing " . $page->url . "</error>");
                    continue;
                }

                $products = $page->products()->find_many();
                foreach ($products as $product) {

                    $found = false;

                    foreach ($rows as $row) {
                        if ($product->format == $row['format']) {

                            $price = \Model::factory('TET\Model\Price')->create();
                            $price->product_id = $product->id;
                            $price->site_id = $site->id;
                            $price->qty = isset($row['qty']) ? $row['qty'] : 1;
                            $price->price = $row['price'] ? $row['price'] * $site->factor : NULL;
                            $price->special_price = $row['special_price'] ? $row['special_price'] * $site->factor : NULL;
                            $price->save();

                            $found = true;

                        }
                    }

                    if (!$found) {
                        $output->writeln("<error>Information for product '" . $product->name . "' not found in " . $page->url . "</error>");
                    }

                }

                sleep($delay);
                $count++;

            }

        }

        if ($count == 0) {
            $output->writeln("<error>No sites processed</error>");
        }

    }

}
