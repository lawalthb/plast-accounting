<?php 

namespace App\Exports;
use App\Models\Stocks;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class StocksListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Stocks::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Product Id',
			'Particular',
			'Reg Date',
			'Stock In',
			'Stock Out',
			'Stock Balance',
			'Doc No',
			'User Id',
			'Company Id',
			'Amount In',
			'Amount Out',
			'Ledger Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->product_id,
			$record->particular,
			$record->reg_date,
			$record->stock_in,
			$record->stock_out,
			$record->stock_balance,
			$record->doc_no,
			$record->user_id,
			$record->company_id,
			$record->amount_in,
			$record->amount_out,
			$record->ledger_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
