<?php 

namespace App\Exports;
use App\Models\Companies;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CompaniesListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Companies::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Name',
			'Slogan',
			'Address',
			'Logo',
			'Website',
			'Favicon',
			'Com Email',
			'Com Phone',
			'Signature'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->name,
			$record->slogan,
			$record->address,
			$record->logo,
			$record->website,
			$record->favicon,
			$record->com_email,
			$record->com_phone,
			$record->signature
        ];
    }
}
