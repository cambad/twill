<?php

namespace A17\Twill\Classes\Export;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataByLocale implements FromArray, WithTitle, WithHeadings, ShouldAutoSize
{
    public $data;
    public $locale;

    public function __construct(array $data, string $locale){
        $this->locale = $locale;
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function title(): string
    {
        return strtoupper($this->locale);
    }

    public function headings(): array
    {
        return collect($this->data[0])->filter(function ($item) {
            return !is_array($item);
        })->keys()->map(function ($header) {
            return Str::headline($header);
        })->toArray();
    }
}
