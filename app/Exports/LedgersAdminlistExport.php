<?php 

namespace App\Exports;
use App\Models\Ledgers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class LedgersAdminlistExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Ledgers::exportAdminlistFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Company Id',
			'Sub Account Group Id',
			'Ledger Name',
			'Marketer Id',
			'Address',
			'Email',
			'Phone',
			'Contact Person',
			'Credit Amount',
			'Debit Amount',
			'Is Active',
			'User Id',
			'Reg Date',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->company_id,
			$record->sub_account_group_id,
			$record->ledger_name,
			$record->marketer_id,
			$record->address,
			$record->email,
			$record->phone,
			$record->contact_person,
			$record->credit_amount,
			$record->debit_amount,
			$record->is_active,
			$record->user_id,
			$record->reg_date,
			$record->date_created,
			$record->date_updated
        ];
    }
}
