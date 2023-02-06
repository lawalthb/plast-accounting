<?php 

namespace App\Exports;
use App\Models\Options;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class OptionsAdminlistExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Options::exportAdminlistFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Option Name',
			'Option Value',
			'Company Id',
			'Date Created',
			'Date Updated',
			'Updated By'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->option_name,
			$record->option_value,
			$record->company_id,
			$record->date_created,
			$record->date_updated,
			$record->updated_by
        ];
    }
}
