<?php

namespace Cp\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Cp\Frontend\Models\ContactUs;
use Illuminate\Http\Request;

class AdminContactUsController extends Controller
{
    public function index(Request $request)
    {
        menuSubmenu('frontend', 'contact_messages');

        $q = trim((string) $request->get('q', ''));

        $messages = ContactUs::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('full_name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('subject', 'like', "%{$q}%")
                        ->orWhere('number', 'like', "%{$q}%")
                        ->orWhere('message', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('frontend::admin.contactMessages.index', compact('messages', 'q'));
    }

    public function destroy(ContactUs $contact)
    {
        $contact->delete();
        toast('Deleted', 'success');
        return redirect()->back();
    }

    public function bulkDestroy(Request $request)
    {
        $ids = collect($request->input('ids', []))
            ->filter(fn ($v) => is_numeric($v))
            ->map(fn ($v) => (int) $v)
            ->unique()
            ->values();

        if ($ids->isEmpty()) {
            toast('No message selected', 'warning');
            return redirect()->back();
        }

        ContactUs::whereIn('id', $ids)->delete();
        toast('Selected messages deleted', 'success');
        return redirect()->back();
    }

    public function printSelected(Request $request)
    {
        $ids = collect($request->input('ids', []))
            ->filter(fn ($v) => is_numeric($v))
            ->map(fn ($v) => (int) $v)
            ->unique()
            ->values();

        $messages = ContactUs::query()
            ->when($ids->isNotEmpty(), fn ($q) => $q->whereIn('id', $ids))
            ->latest()
            ->get();

        return view('frontend::admin.contactMessages.print', compact('messages'));
    }
}

