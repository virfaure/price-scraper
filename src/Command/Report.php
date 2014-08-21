<?php

namespace TET\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Respect\Config\Container;

class Report extends Command {

    protected function configure() {

        $sites =  \Model::factory('TET\Model\Site')
            ->where_not_equal('spider', 'NULL')
            ->where_equal('active', 1)
            ->find_many();

        $sites = array_map(function($site) { return $site->name; }, $sites->as_array());

        $this
            ->setName('tet:report')
            ->setDescription('Generates reports')
            ->addOption('site', NULL, InputOption::VALUE_REQUIRED, "Site to report, available options:\n\t\t* " . join($sites, "\n\t\t* "))
            ->addOption('ean', NULL, InputOption::VALUE_REQUIRED, "Product to report")
            ->addOption('hours', NULL, InputOption::VALUE_REQUIRED, "Report last N hours")
            ->addOption('to', NULL, InputOption::VALUE_REQUIRED, "Send report to specified email address")
            ->addOption('bcc', NULL, InputOption::VALUE_REQUIRED, "Send report to specified email address as BCC")
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $site_name = $input->getOption('site');
        $ean = $input->getOption('ean');
        $hours = $input->getOption('hours');
        $mailto = $input->getOption('to');
        $mailbcc = $input->getOption('bcc');

        if ($site_name === NULL && $ean === NULL && $hours == NULL) {
            $output->writeln('<error>You have to specify at least one filtering option (site, ean, hours)</error>');
            exit(1);
        }

        if ($mailto) {
            $mailto = explode(',', $mailto);
            foreach ($mailto as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $output->writeln('<error>' . $email . ' is not a valid email address</error>');
                    exit(1);
                }
            }
        }

        \ORM::configure('caching', true);

        $filename = array('price_comparator_report');

        $prices = \Model::factory('TET\Model\Price')
        //    ->order_by_asc('brand')
        //    ->order_by_asc('name')
        ;
        if ($site_name) {
            $site_id = \Model::factory('TET\Model\Site')
                ->where_equal('name', $site_name)->find_one()->id;
            $prices->where_equal('site_id', $site_id);
            $filename[] = $site_name;
        }
        if ($ean) {
            $product_id = \Model::factory('TET\Model\Product')
                ->where_equal('ean', $ean)->find_one()->id;
            $prices->where_equal('product_id', $product_id);
            $filename[] = $ean;
        }
        if ($hours) {
            $date = new \DateTime();
            $to = $date->format('YmdHis');
            $date->modify("-$hours hours");
            $prices->where_gt('datetime', $date->format('Y-m-d H:i:s'));
            $filename[] = $date->format('YmdHis');
            $filename[] = $to;
        }

        $rows = 0;
        $handler = NULL;
        if ($mailto) {
            $filename = sys_get_temp_dir() . '/' . join('_', $filename) . '.csv';
            $handler = fopen($filename, 'w');
        } else {
            $handler = $output->getStream();
        }

        foreach ($prices->find_many() as $price) {

            $site = $price->site()->find_one();
            $product = $price->product()->find_one();
            $page = $product->page($site->id)->find_one();
            $date = new \Datetime($price->datetime);

            $data = array(
                'BRAND' => $product->brand,
                'EAN' => $product->ean,
                'NAME' => $product->name,
                'SIZE' => $product->size,
                'SPECIALITY' => $product->speciality,
                'ANIMAL' => $product->animal,
                'FORMAT' => $product->format,
                'SITE' => $site->domain,
                'COUNTRY' => $site->country_id,
                'URL' => $page->url,
                'QTY' => $price->qty,
                'PRICE' => $price->price,
                'SPECIAL_PRICE' => $price->special_price,
                'LOWER_PRICE' => $price->special_price ? $price->special_price : $price->price,
                'DATE' => $date->format('Y-m-d'),
                'TIME' => $date->format('H:i:s'),
            );

            if ($rows == 0) {
                fputcsv($handler, array_keys($data));
            }
            fputcsv($handler, array_values($data));
            $rows++;
        
        }

        if ($rows == 0) {
            $output->writeln("<error>Nothing to report</error>");
        } else {

            if ($mailto) {
            
                fclose($handler);

                $c = new Container('config.ini');
                $m = $c->mail;

                $mail = new \PHPMailer();
                if ((bool) $m['use_smtp']) {
                    $mail->isSMTP();
                    $mail->SMTPAuth = $m['auth'];
                    $mail->Host = $m['host'];
                    $mail->Username = $m['user'];
                    $mail->Password = $m['pass'];
                    $mail->SMTPSecure = $m['secure'];
                } else {
                    $mail->isSendmail();
                }
                $mail->From = $m['from_email'];
                $mail->FromName = $m['from_name'];
                foreach ($mailto as $email) {
                    $mail->addAddress($email);
                }
                if ($mailbcc) {
                    $mailbcc = explode(',', $mailbcc);
                    foreach ($mailbcc as $email) {
                        $mail->addBCC($email);
                    }
                }
                $mail->Subject = "Price Comparator Report";
                $mail->addAttachment($filename);
                $mail->Body = $mail->Subject;

                if (!$mail->send()) {
                    $output->writeln("<error>Error sending report: " . $mail->ErrorInfo  . "</error>");
                }

            }

        }


    }

}
