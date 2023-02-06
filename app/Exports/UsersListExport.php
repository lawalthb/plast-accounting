<?php 

namespace App\Exports;
use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UsersListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Users::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Firstname',
			'Lastname',
			'Email',
			'Role Id',
			'Phone',
			'Photo',
			'User Type',
			'Date Join',
			'Is Active',
			'Company Id',
			'Username',
			'Email Verified At',
			'User Role Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->firstname,
			$record->lastname,
			$record->email,
			$record->role_id,
			$record->phone,
			$record->photo,
			$record->user_type,
			$record->date_join,
			$record->is_active,
			$record->company_id,
			$record->username,
			$record->email_verified_at,
			$record->user_role_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
