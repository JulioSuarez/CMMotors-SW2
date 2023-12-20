<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function descargarQR($qr)
    {
        return response()->download($qr)->deleteFileAfterSend(false);
    }
}
