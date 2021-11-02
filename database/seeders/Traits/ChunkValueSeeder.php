<?php

namespace Database\Seeders\Traits;

trait ChunkValueSeeder
{
    /**
     * @param $records
     * @return int
     */
    public function chunkValue($records): int
    {
        if ($records > 10000) {
            return 500;
        } elseif ($records > 5000) {
            return 200;
        } elseif ($records > 1000) {
            return 100;
        } elseif ($records > 100) {
            return 50;
        } elseif ($records > 10) {
            return 5;
        } else {
            return 1;
        }
    }
}
