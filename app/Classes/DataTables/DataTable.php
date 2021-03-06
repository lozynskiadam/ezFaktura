<?php

namespace App\Classes\DataTables;

class DataTable
{
    /** https://datatables.net/reference/option/dom */
    public $dom;

    /** https://datatables.net/reference/option/columns */
    public $columns;

    /** https://datatables.net/reference/option/data */
    public $data;

    /** https://datatables.net/reference/option/drawCallback */
    public $drawCallback;

    /** https://datatables.net/reference/option/createdRow */
    public $createdRow;

    /** https://datatables.net/reference/option/buttons */
    public $buttons;

    /** https://datatables.net/reference/option/language */
    public $language;

    public function __construct()
    {
        $this->dom = 'Bfrt<"row"<"col-md-6"l><"col-md-6"p>>';
        $this->columns = [];
        $this->buttons = [];
        $this->data = [];
        $this->drawCallback = null;
        $this->createdRow = null;
        $this->language = [
            'emptyTable' =>  __('translations.datatable.emptyTable'),
            'search' =>  __('translations.datatable.search'),
            'info' =>  __('translations.datatable.info'),
            'infoEmpty' =>  __('translations.datatable.infoEmpty'),
            'infoFiltered' => __('translations.datatable.infoFiltered'),
            'zeroRecords' =>  __('translations.datatable.zeroRecords'),
            'lengthMenu' =>  __('translations.datatable.lengthMenu'),
            'paginate' => [
                'first' => __('translations.datatable.paginate.first'),
                'last' => __('translations.datatable.paginate.last'),
                'next' => __('translations.datatable.paginate.next'),
                'previous' => __('translations.datatable.paginate.previous'),
            ]
        ];
    }

    public function getJSON(): string
    {
        $options = [];
        foreach ($this as $key => $value) if ($value !== null) {
            $options[$key] = $value;
        }
        return json_encode($options);
    }

}