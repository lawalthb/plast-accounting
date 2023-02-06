<?php 

namespace App\Exports;
use App\Models\Transaction_Products;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class TransactionProductsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Transaction_Products::exportListFields());
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
			'Product Id',
			'Quantity',
			'Rate',
			'Amount',
			'Comment',
			'Location Id',
			'Company Id',
			'Tp Date',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->transactions_id,
			$record->product_id,
			$record->quantity,
			$record->rate,
			$record->amount,
			$record->comment,
			$record->location_id,
			$record->company_id,
			$record->tp_date,
			$record->date_created,
			$record->date_updated
        ];
    }
}
