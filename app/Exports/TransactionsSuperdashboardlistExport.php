<?php 

namespace App\Exports;
use App\Models\Transactions;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class TransactionsSuperdashboardlistExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Transactions::exportSuperdashboardlistFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Trans Date',
			'Reference',
			'Party Ledger Id',
			'Against Ledger Id',
			'Document Type Id',
			'Total Debit',
			'Total Credit',
			'Company Id'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->trans_date,
			$record->reference,
			$record->party_ledger_id,
			$record->against_ledger_id,
			$record->document_type_id,
			$record->total_debit,
			$record->total_credit,
			$record->company_id
        ];
    }
}
