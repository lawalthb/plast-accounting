<?php 

namespace App\Exports;
use App\Models\Document_Types;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class DocumentTypesListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Document_Types::exportListFields());
    }
	
    public function query()
    {
        return $this->query;
    }
	
	public function headings(): array
    {
        return [
			'Id',
			'Name',
			'Method Numbering',
			'Prefix',
			'Starting Num',
			'Common Description',
			'Print Onsave',
			'Desc Each Line',
			'Document Code',
			'Company Id',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->name,
			$record->method_numbering,
			$record->prefix,
			$record->starting_num,
			$record->common_description,
			$record->print_onsave,
			$record->desc_each_line,
			$record->document_code,
			$record->company_id,
			$record->date_created,
			$record->date_updated
        ];
    }
}
