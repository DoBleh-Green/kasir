<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Struk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    public function index()
    {
        return view('admin-page.history.index');
    }

    function view_pdf()
    {
        // Mengambil data dari database
        $historyPembelian = Struk::all();


        // Mulai menginisialisasi objek mPDF
        $mpdf = new Mpdf();

        // Membuat isi tabel HTML dengan menambahkan gaya CSS
        $html = '<style>
                    table {
                        border-collapse: collapse;
                        margin-bottom: 20px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                    h1{
                        text-align:center;
                    }
                </style>
                <h1>Laporan Pembelian</h1>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kasir</th>
                            <th>Items</th>
                            <th>Total_harga</th>
                            <th>Tanggal dibuat</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($historyPembelian as $index => $struk) {
            $html .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . $struk->nama_kasir . '</td>
                        <td>' . json_encode($struk->items) . '</td>
                        <td>' . $struk->total_harga . '</td>
                        <td>' . $struk->created_at . '</td>
                    </tr>';

        }

        // Menutup tabel HTML
        $html .= '</tbody></table>';

        // Menambahkan isi HTML ke objek mPDF
        $mpdf->WriteHTML($html);

        // Menyimpan atau menampilkan file PDF
        $mpdf->Output();
    }

}
