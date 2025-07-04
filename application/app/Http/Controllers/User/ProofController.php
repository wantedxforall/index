<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Proof;
use Illuminate\Support\Facades\Auth;

class ProofController extends Controller
{
    public function show($proofId)
    {
        $proof = Proof::with('service')->findOrFail($proofId);
        $user = Auth::user();

        if ($proof->user_id !== $user->id && $proof->service->user_id !== $user->id) {
            abort(403);
        }

        $path = base_path('assets/images/proofs/' . $proof->screenshort);
        abort_unless(file_exists($path), 404);

        return response()->file($path);
    }
}