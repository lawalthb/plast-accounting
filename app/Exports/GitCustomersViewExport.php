<?php 

namespace App\Exports;
use App\Models\Git_Customers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class GitCustomersViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(Git_Customers::exportViewFields());
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
			'Git Insurance Id',
			'Customer Name',
			'Invoice No',
			'Amount',
			'Comment'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->git_insurance_id,
			$record->customer_name,
			$record->invoice_no,
			$record->amount,
			$record->comment
        ];
    }
}
