<?php

namespace App\Http\Controllers;

use App\Enums\LetterType;
use App\Helpers\GeneralHelper;
use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateLetterRequest;
use App\Models\Attachment;
use App\Models\Classification;
use App\Models\Config;
use App\Models\Disposition;
use App\Models\Letter;
use App\Models\LetterStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RekapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    // public function index(Request $request): View
    // {


    //     return view('pages.rekapan.index', [
    //         'data' => Letter::get(),
    //         'periode' => $request->periode,
    //         'type' => $request->type,
    //         'incomingLetter' => $incomingLetter,
    //         'outgoingLetter' => $outgoingLetter,
    //         'dispositionLetter' => $dispositionLetter,
    //         'letterTransaction' => $letterTransaction,
    //         'activeUser' => User::active()->count()
    //     ]);
    // }

    public function index(Request $request): View
    {
        $periode = $request->periode;
        $type    = $request->type;
        $label   = "Semua";

        // base query
        $letters = Letter::query();

        // filter by periode (pakai letter_date)
        if ($periode === 'today') {
            $letters->whereDate('letter_date', today());
            $label = "Hari Ini";
        } elseif ($periode === 'thisMonth') {
            $letters->whereMonth('letter_date', now()->month)
                ->whereYear('letter_date', now()->year);
            $label = "Bulan Ini";
        } elseif ($periode === 'thisYear') {
            $letters->whereYear('letter_date', now()->year);
            $label = "Tahun Ini";
        }

        // filter by type (incoming / outgoing)
        if ($type === 'incoming') {
            $letters->where('type', LetterType::INCOMING->type());
        } elseif ($type === 'outgoing') {
            $letters->where('type', LetterType::OUTGOING->type());
        }

        // clone query for counting (avoid re-using the same builder)
        $baseLetters = clone $letters;

        $incomingLetter = (clone $baseLetters)
            ->where('type', LetterType::INCOMING->type())
            ->count();

        $outgoingLetter = (clone $baseLetters)
            ->where('type', LetterType::OUTGOING->type())
            ->count();

        // filter disposition juga sebaiknya konsisten pakai letter_date (kalau ada fieldnya)
        $dispositionLetter = Disposition::when($periode, function ($query) use ($periode) {
            if ($periode === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($periode === 'thisMonth') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            } elseif ($periode === 'thisYear') {
                $query->whereYear('created_at', now()->year);
            }
        })->count();

        $letterTransaction = (clone $baseLetters)->count();

        return view('pages.rekapan.index', [
            'data'              => $letters->get(),
            'label'             => $label,
            'periode'           => $periode,
            'type'              => $type,
            'incomingLetter'    => $incomingLetter,
            'outgoingLetter'    => $outgoingLetter,
            'dispositionLetter' => $dispositionLetter,
            'letterTransaction' => $letterTransaction,
            'activeUser'        => User::active()->count(),
        ]);
    }


    public function printRekapan(Request $request)
    {
        $periode = $request->periode;
        $type    = $request->type;
        $label   = "Semua";

        // base query
        $letters = Letter::query();

        // filter by periode (pakai letter_date)
        if ($periode === 'today') {
            $letters->whereDate('letter_date', today());
            $label = "Hari Ini";
        } elseif ($periode === 'thisMonth') {
            $letters->whereMonth('letter_date', now()->month)
                ->whereYear('letter_date', now()->year);
            $label = "Bulan Ini";
        } elseif ($periode === 'thisYear') {
            $letters->whereYear('letter_date', now()->year);
            $label = "Tahun Ini";
        }

        // filter by type (incoming / outgoing)
        if ($type === 'incoming') {
            $letters->where('type', LetterType::INCOMING->type());
        } elseif ($type === 'outgoing') {
            $letters->where('type', LetterType::OUTGOING->type());
        }

        // clone query for counting (avoid re-using the same builder)
        $baseLetters = clone $letters;

        $incomingLetter = (clone $baseLetters)
            ->where('type', LetterType::INCOMING->type())
            ->count();

        $outgoingLetter = (clone $baseLetters)
            ->where('type', LetterType::OUTGOING->type())
            ->count();

        // filter disposition juga sebaiknya konsisten pakai letter_date (kalau ada fieldnya)
        $dispositionLetter = Disposition::when($periode, function ($query) use ($periode) {
            if ($periode === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($periode === 'thisMonth') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            } elseif ($periode === 'thisYear') {
                $query->whereYear('created_at', now()->year);
            }
        })->count();

        $letterTransaction = (clone $baseLetters)->count();

        // You can use a package like barryvdh/laravel-dompdf for PDF export, or just return a print view
        // For simplicity, let's return a print-friendly view

        return view('pages.rekapan.print_rekapan', [
            'data' => $letters->get(),
            'label' => $label,
            'periode' => $periode,
            'type' => $type,
            'incomingLetter'    => $incomingLetter,
            'outgoingLetter'    => $outgoingLetter,
            'dispositionLetter' => $dispositionLetter,
            'letterTransaction' => $letterTransaction,
            'config' => Config::pluck('value', 'code')->toArray(),
            'activeUser'        => User::active()->count(),
            'title' => "Laporan Rekapan"
        ]);
    }
}
