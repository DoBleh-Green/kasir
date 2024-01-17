<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
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
        // Mengambil data pengguna dengan peran 'kasir'
        $kasirUsers = \App\Models\User::where('role', 'kasir')->get();

        // Mulai menginisialisasi objek mPDF
        $mpdf = new Mpdf();

        // Membuat isi tabel HTML dengan menambahkan gaya CSS
        $html = '<style>
                    table {
                        width: 100%;
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Menambahkan data pengguna ke dalam tabel HTML
        foreach ($kasirUsers as $index => $user) {
            $html .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . $user->name . '</td>
                        <td>' . $user->email . '</td>
                        <td>Hidden</td>
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
