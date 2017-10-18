<?php

namespace App\Http\Controllers;
use Excel;

class UserListImport extends \Maatwebsite\Excel\Files\ExcelFile {

    public function getFile()
    {
        return 'dos.xlsm';
       
    }

    public function getFilters()
    {
        return [
            
        ];
    }

}


