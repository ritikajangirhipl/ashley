<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Yajra\DataTables\Exports\DataTablesCollectionExport;

class HolderSubmissionsExport extends DataTablesCollectionExport implements WithMapping
{
	public function headings(): array
    {
        return [
            trans('cruds.holder_submissions.fields.submission_date'),
            trans('cruds.holder_submissions.fields.submission_ref'),
            trans('cruds.holder_submissions.fields.student_id'),
            trans('cruds.holder_submissions.fields.issuer_id'),
            trans('cruds.holder_submissions.fields.school_name'),
            trans('cruds.holder_submissions.fields.start_year'),
            trans('cruds.holder_submissions.fields.end_year'),
            trans('cruds.holder_submissions.fields.receiver_id'),
            trans('cruds.holder_submissions.fields.receiver_reference'),
            trans('cruds.holder_submissions.fields.fees_to_pay'),
        ];
    }

    public function map($row): array
    {
        return [
            $row['submission_date'],
            $row['submission_ref'],
            $row['students']['name'],
            $row['issuer']['name'],
            $row['school_name'],
            $row['start_year'],
            $row['end_year'],
            $row['receiver']['name'],
            $row['receiver_reference'],
            $row['fees_to_pay'],
        ];
    }
}
