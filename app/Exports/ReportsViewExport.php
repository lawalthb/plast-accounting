<?php 

namespace App\Exports;
use App\Models\Reports;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ReportsViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Reports::exportViewFields());
        $this->rec_id = $rec_id;
    }


    public function query()
    {
        return $this->query->where("id", $this->rec_id);
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
			'Last View Time'
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
			$record->last_view_time
        ];
    }
}
