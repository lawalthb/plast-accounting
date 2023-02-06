<?php 

namespace App\Exports;
use App\Models\Narrations;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class NarrationsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Narrations::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Narration',
			'Status',
			'Trans Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->narration,
			$record->status,
			$record->trans_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
