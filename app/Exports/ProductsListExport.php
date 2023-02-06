<?php 

namespace App\Exports;
use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ProductsListExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	
	protected $query;
	
    public function __construct($query)
    {
        $this->query = $query->select(Products::exportListFields());
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
			'Name',
			'Category',
			'Image',
			'Mfg Date',
			'Exp Date',
			'Qty',
			'Selling Price',
			'Purchase Price',
			'Dead Stock',
			'Is Active',
			'User Id',
			'Unit'
        ];
    }
	
    public function map($record): array
    {
        return [
			$record->id,
			$record->company_id,
			$record->name,
			$record->category,
			$record->image,
			$record->mfg_date,
			$record->exp_date,
			$record->qty,
			$record->selling_price,
			$record->purchase_price,
			$record->dead_stock,
			$record->is_active,
			$record->user_id,
			$record->unit
        ];
    }
}
