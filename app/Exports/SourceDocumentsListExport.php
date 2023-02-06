<?php 

namespace App\Exports;
use App\Models\Source_Documents;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class SourceDocumentsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Source_Documents::exportListFields());
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
			'Numbering',
			'Document Type',
			'Have Comment',
			'Auto Print',
			'Display Title',
			'Declaration',
			'Is Active',
			'User Id',
			'Company Id',
			'For Inventory',
			'Date Created',
			'Date Updated'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->name,
			$record->numbering,
			$record->document_type,
			$record->have_comment,
			$record->auto_print,
			$record->display_title,
			$record->declaration,
			$record->is_active,
			$record->user_id,
			$record->company_id,
			$record->for_inventory,
			$record->date_created,
			$record->date_updated
        ];
    }
}
