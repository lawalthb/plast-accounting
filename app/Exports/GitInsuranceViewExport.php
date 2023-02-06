<?php 

namespace App\Exports;
use App\Models\Git_Insurance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class GitInsuranceViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Git_Insurance::exportViewFields());
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
			'Git No',
			'Vehicle No',
			'Item Type',
			'Reg Date',
			'Driver Name',
			'Load From',
			'Going To',
			'Total Amount',
			'Is Active',
			'Date Created',
			'Date Updated',
			'Company Id',
			'Mail Sent',
			'Charges'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->git_no,
			$record->vehicle_no,
			$record->item_type,
			$record->reg_date,
			$record->driver_name,
			$record->load_from,
			$record->going_to,
			$record->total_amount,
			$record->is_active,
			$record->date_created,
			$record->date_updated,
			$record->company_id,
			$record->mail_sent,
			$record->charges
        ];
    }
}
