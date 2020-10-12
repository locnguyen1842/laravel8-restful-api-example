<?php

namespace App\Enums\Validation;

class ValidationRuleErrorCode extends BaseErrorCodeEnum
{
    public static function all()
    {
        return [
            'Accepted' => '001',
            'After' => '002',
            'AfterOrEqual' => '003',
            'Before' => '004',
            'BeforeOrEqual' => '005',
            'Between' => '006',
            'Confirmed' => '007',
            'Date' => '008',
            'DateFormat' => '009',
            'Different' => '010',
            'Dimensions' => '011',
            'ExcludeIf' => '012',
            'ExcludeUnless' => '013',
            'ExcludeWithout' => '014',
            'File' => '015',
            'Filled' => '016',
            'Gt' => '017',
            'Gte' => '018',
            'Image' => '019',
            'Integer' => '020',
            'Lt' => '021',
            'Lte' => '022',
            'Max' => '023',
            'Mimes' => '024',
            'Mimetypes' => '025',
            'Min' => '026',
            'Numeric' => '027',
            'Present' => '028',
            'Required' => '029',
            'RequiredIf' => '030',
            'RequiredUnless' => '031',
            'RequiredWith' => '032',
            'RequiredWithAll' => '033',
            'RequiredWithout' => '034',
            'RequiredWithoutAll' => '035',
            'Same' => '036',
            'Size' => '037',
            'Unique' => '038',
        ];
    }
}