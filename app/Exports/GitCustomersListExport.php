<?php 

namespace App\Exports;
use App\Models\Git_Customers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class GitCustomersListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Git_Customers::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
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
