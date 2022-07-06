<?php

namespace A17\Twill\Classes\Export;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportData implements WithMultipleSheets
{
    use Exportable;

    public $data;

    public function __construct(array $data){
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->data as $language => $items) {
            $sheets[$language] = new DataByLocale($items, $language);
        }
        return $sheets;
    }
}
