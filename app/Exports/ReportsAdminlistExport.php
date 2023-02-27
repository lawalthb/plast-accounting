<?php 

namespace App\Exports;
use App\Models\Reports;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ReportsAdminlistExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Reports::exportAdminlistFields());
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
			'Link',
			'Company Id',
			'Is Active',
			'No Views',
			'Last View Time',
			'Report Code'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->name,
			$record->link,
			$record->company_id,
			$record->is_active,
			$record->no_views,
			$record->last_view_time,
			$record->report_code
        ];
    }
}
