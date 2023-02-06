<?php 

namespace App\Exports;
use App\Models\Transaction_Ledgers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class TransactionLedgersListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Transaction_Ledgers::exportListFields());
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
			'Ledger Id',
			'Debit Id',
			'Credit Id',
			'Comment',
			'Company Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->transactions_id,
			$record->ledger_id,
			$record->debit_id,
			$record->credit_id,
			$record->comment,
			$record->company_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
