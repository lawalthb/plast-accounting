<?php 

namespace App\Exports;
use App\Models\Audits;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class AuditsViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Audits::exportViewFields());
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
			'User Type',
			'User Id',
			'Event',
			'Auditable Type',
			'Auditable Id',
			'Old Values',
			'New Values',
			'Url',
			'Ip Address',
			'User Agent',
			'Tags',
			'Created At',
			'Updated At'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->user_type,
			$record->user_id,
			$record->event,
			$record->auditable_type,
			$record->auditable_id,
			$record->old_values,
			$record->new_values,
			$record->url,
			$record->ip_address,
			$record->user_agent,
			$record->tags,
			$record->created_at,
			$record->updated_at
        ];
    }
}
