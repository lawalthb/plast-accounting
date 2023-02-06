<?php 

namespace App\Exports;
use App\Models\Marketers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class MarketersListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Marketers::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Company Id',
			'Name',
			'User Id',
			'Is Active',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->company_id,
			$record->name,
			$record->user_id,
			$record->is_active,
			$record->date_created,
			$record->date_updated
        ];
    }
}
