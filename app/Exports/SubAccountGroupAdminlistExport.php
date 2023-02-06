<?php 

namespace App\Exports;
use App\Models\Sub_Account_Group;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class SubAccountGroupAdminlistExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Sub_Account_Group::exportAdminlistFields());
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
			'Account Group Id',
			'Name',
			'Code',
			'Description',
			'Total Amount',
			'User Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->company_id,
			$record->account_group_id,
			$record->name,
			$record->code,
			$record->description,
			$record->total_amount,
			$record->user_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
