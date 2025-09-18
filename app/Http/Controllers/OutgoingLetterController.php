<?php

namespace App\Http\Controllers;

use App\Enums\LetterType;
use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateLetterRequest;
use App\Models\Attachment;
use App\Models\Classification;
use App\Models\Letter;
use App\Models\LetterHead;
use App\Models\LetterStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OutgoingLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('pages.transaction.outgoing.index', [
            'search' => $request->search,
            'data' => Letter::outgoing()->outgoingFilter($request->since, $request->until, $request->filter, $request->status)->render($request->search),
            'since' => $request->since,
            'until' => $request->until,
            'filter' => $request->filter,
            'search' => $request->search,
            'query' => $request->getQueryString(),
            'status' => $request->status,
            'statuses' => LetterStatus::all(),
        ]);
    }

    /**
     * Display a listing of the outgoing letter agenda.
     *
     * @param Request $request
     * @return View
    */
    public function agenda(Request $request): View
    {
        return view('pages.transaction.outgoing.agenda', [
            'search' => $request->search,
            'data' => Letter::outgoing()->outgoingFilter($request->since, $request->until, $request->filter, $request->status)->render($request->search),
            'since' => $request->since,
            'until' => $request->until,
            'filter' => $request->filter,
            'search' => $request->search,
            'query' => $request->getQueryString(),
            'status' => $request->status,
            'statuses' => LetterStatus::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function print_agenda(Request $request): View
    {
        $agenda = __('menu.agenda.menu');
        $letter = __('menu.agenda.outgoing_letter');
        $title = App::getLocale() == 'id' ? "$agenda $letter" : "$letter $agenda";
        $letterHead = LetterHead::find(1);
        return view('pages.transaction.outgoing.print_agenda', [
            'data' => Letter::outgoing()->agenda($request->since, $request->until, $request->filter)->get(),
            'search' => $request->search,
            'since' => $request->since,
            'until' => $request->until,
            'filter' => $request->filter,
            'title' => $title,
            'letterHead' => $letterHead,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request): View
    {
        return view('pages.transaction.outgoing.create', [
            'classifications' => Classification::all(),
            'mode' => $request->mode
        ]);
    }

    public function letter_preview(Request $request): View {
        $letterHead = LetterHead::find(1);
        return view('pages.letter_preview', [
            'content'    => $request->content,
            'letterHead' => $letterHead
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLetterRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLetterRequest $request): RedirectResponse | View
    {
        try {
            $user = auth()->user();

            if ($request->type != LetterType::OUTGOING->type()) throw new \Exception(__('menu.transaction.outgoing_letter'));
            $newLetter = $request->validated();
            $newLetter['user_id'] = $user->id;
            $letter = Letter::create($newLetter);

            // if ($request->mode == "tulis" && $request->content) {
            //     // Generate unique filename
            //     $filename = time() . '_' . uniqid() . '.html';
            
            //     // Path untuk simpan di public/attachments
            //     $path = storage_path('app/public/attachments/' . $filename);

            //     $letterHead = LetterHead::find(1); 
            
            //     // Simpan content jadi file HTML
            //     file_put_contents($path, $letterHead->content . $request->content . '</body></html>');
            
            //     // Simpan ke database
            //     Attachment::create([
            //         'filename'  => $filename,
            //         'extension' => 'html',
            //         'user_id'   => $user->id,
            //         'letter_id' => $letter->id,
            //     ]);
            // }
            
            if ($request->hasFile('attachments')) {
                foreach ($request->attachments as $attachment) {
                    $extension = $attachment->getClientOriginalExtension();
                    if (!in_array($extension, ['png', 'jpg', 'jpeg', 'pdf'])) continue;
                    $filename = time() . '-' . $attachment->getClientOriginalName();
                    $filename = str_replace(' ', '-', $filename);
                    $attachment->storeAs('public/attachments', $filename);
                    Attachment::create([
                        'filename' => $filename,
                        'extension' => $extension,
                        'user_id' => $user->id,
                        'letter_id' => $letter->id,
                    ]);
                }
            }
            return redirect()
                ->route('transaction.outgoing.index')
                ->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Letter $outgoing
     * @return View
     */
    public function show(Letter $outgoing): View
    {
        return view('pages.transaction.outgoing.show', [
            'data' => $outgoing->load(['classification', 'user', 'attachments']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Letter $outgoing
     * @return View
     */
    public function edit(Letter $outgoing): View
    {
        return view('pages.transaction.outgoing.edit', [
            'data' => $outgoing,
            'classifications' => Classification::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLetterRequest $request
     * @param Letter $outgoing
     * @return RedirectResponse
     */
    public function update(UpdateLetterRequest $request, Letter $outgoing): RedirectResponse
    {
        try {
            $outgoing->update($request->validated());
            if ($request->hasFile('attachments')) {
                foreach ($request->attachments as $attachment) {
                    $extension = $attachment->getClientOriginalExtension();
                    if (!in_array($extension, ['png', 'jpg', 'jpeg', 'pdf'])) continue;
                    $filename = time() . '-' . $attachment->getClientOriginalName();
                    $filename = str_replace(' ', '-', $filename);
                    $attachment->storeAs('public/attachments', $filename);
                    Attachment::create([
                        'filename' => $filename,
                        'extension' => $extension,
                        'user_id' => auth()->user()->id,
                        'letter_id' => $outgoing->id,
                    ]);
                }
            }
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Letter $outgoing
     * @return RedirectResponse
     */
    public function destroy(Letter $outgoing): RedirectResponse
    {
        try {
            $outgoing->delete();
            return redirect()
                ->route('transaction.outgoing.index')
                ->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function print(Letter $letter): View
    {
        return view('pages.transaction.outgoing.print', [
            'letter' => $letter,
        ]);
    }

    public function sign(Letter $letter): RedirectResponse
    {
        try {
            $letter->update([
                'signed' => true,
            ]);

            return redirect()
                ->route('transaction.outgoing.show', $letter->id) // kasih params
                ->with('success', "Surat berhasil ditandatangani.");
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

}
