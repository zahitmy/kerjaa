<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DB;
use stdClass;
use Illuminate\Support\Facades\Storage;
date_default_timezone_set("Asia/Kuala_lumpur");

class FormController extends Controller
{
    public function getFormDefinition()
    {
        $formDefinition = [
            'formFields' => [
                ['type' => 'text', 'label' => 'Nama', 'name' => 'nama', 'required' => true],
                ['type' => 'email', 'label' => 'Email', 'name' => 'email', 'required' => true],
                ['type' => 'date', 'label' => 'Tanggal Lahir', 'name' => 'tanggal_lahir', 'required' => true],
                ['type' => 'camera', 'label' => 'Jobsheet', 'name' => 'Jobsheet', 'required' => true],
                ['type' => 'dropdown', 'label' => 'Jobsheet', 'name' => 'Jobsheet', 'required' => true, 'options' => ['Option 1', 'Option 2', 'Option 3']],
                // ... tambahkan definisi untuk jenis field lainnya
                ['type' => 'config', 'title' => 'Exit Form', 'max_img' => 9, 'message_success' => 'Berjaya Exit Form',]
                
            ],
        ];

        return response()->json($formDefinition);
    }
    /// ini adalah contoh-contoh type
    // dropdown | camera | text | date | email
    //
    //
    //
    //
    public function getFormClockIn()
    {
        $formDefinition = [
            'formFields' => [
                ['type' => 'dropdown', 'label' => 'Venue', 'name' => 'venue', 'required' => true, 'options' => ['Option 1', 'Option 2', 'Option 3']],
                ['type' => 'dropdown', 'label' => 'Customer Name', 'name' => 'customer', 'required' => true, 'options' => ['Option 1', 'Option 2', 'Option 3']],
                ['type' => 'camera', 'label' => 'Picture Sticker Machine', 'name' => 'image', 'required' => true],
                ['type' => 'dropdown', 'label' => 'Type Of Call', 'name' => 'callType', 'required' => true, 'options' => ['Option 1', 'Option 2', 'Option 3']],
                ['type' => 'text', 'label' => 'Remark', 'name' => 'remark', 'required' => false,],
                // ... tambahkan definisi untuk jenis field lainnya
                ['type' => 'config', 'title' => 'Job Handling', 'max_img' => 1, 'message_success' => 'Berjaya Clock-IN',]
                
            ],
        ];

        return response()->json($formDefinition);
    }

    //exit-form
    public function getFormExitForm()
    {
        $formDefinition = [
            'formFields' => [
                ['type' => 'dropdown', 'label' => 'Exit', 'name' => 'exit_type', 'required' => true, 'options' => ['Exit Morning', 'Exit Evening']],
                ['type' => 'dropdown', 'label' => 'Customer Name', 'name' => 'customer', 'required' => true, 'options' => ['Option 1', 'Option 2', 'Option 3']],
                ['type' => 'camera', 'label' => 'Jobsheet Last Call', 'name' => 'image', 'required' => true],
                ['type' => 'text', 'label' => 'Last Call Time', 'name' => 'last_call', 'required' => true],
                ['type' => 'text', 'label' => 'Remark', 'name' => 'remark', 'required' => false,],
                // ... tambahkan definisi untuk jenis field lainnya
                ['type' => 'config', 'title' => 'Exit Form', 'max_img' => 9, 'message_success' => 'Berjaya Exit Form',]
                
            ],
        ];

        return response()->json($formDefinition);
    }
}

