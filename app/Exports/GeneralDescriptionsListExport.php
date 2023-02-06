<?php 

namespace App\Exports;
use App\Models\General_Descriptions;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class GeneralDescriptionsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(General_Descriptions::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Transactions Id',
			'Content',
			'Decs Date',
			'Company Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->transactions_id,
			$record->content,
			$record->decs_date,
			$record->company_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
