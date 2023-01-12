<?php

namespace App\Services;

use Spatie\DbDumper\Databases\MySql;

class ExportDbService
{
    public function exportDB(): string
    {
        $path = $this->getTmpFilename();
        MySql::create()
            ->setDumpBinaryPath(env('MYSQLDUMP_PATH', ''))
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->dumpToFile($path);

        return $path;
    }

    private function getTmpFilename(): string
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'dump_' . date('Y_m_d_H_i_s') . '.sql';
    }
}
