<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return ["ID", "Name", "Email", "Phone", "Status", "Created At", "Updated At"];
    }
  
    public function collection()
    {
        $data = Customer::select('id', 'name', 'email', 'phone', 'status', 'created_at', 'updated_at')->get();
        return $data;
    }

    public function map($data): array
    {
        return [
          $data->id,
          $data->name,
        //   $data->last_name,
        //   $data->business_name,
          $data->email,
          $data->phone,
          $data->status,
        //   $data->address,
        //   $data->date_of_birth,
          $data->created_at,
          $data->updated_at,

        ];
    }
}
